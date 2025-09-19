<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tnx;
use App\Models\Links;
use App\Models\Merchants;
use App\Service\SMSService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AllMerchantLinksExport;
use App\Http\Requests\LinkUpdateRequest;
use App\Models\sms;

class AdminSmScontroller extends Controller
{
    //
    protected SMSService $SMSService;

    public function __construct(SMSService $SMSService)
    {
        $this->SMSService = $SMSService;
    }

    public function index(Request $request)
    {
        $links = Links::query()
            ->whereNotIn('id', function ($q) {
                $q->select('link_id')->from('tnxes');
            })
            ->when(
                $request->start_date,
                fn($q) =>
                $q->where('created_at', '>=', $request->start_date)
            )
            ->when(
                $request->end_date,
                fn($q) =>
                $q->where('created_at', '<=', $request->end_date)
            )
            ->when(
                $request->notification_type,
                fn($q) =>
                $q->where('link_type', $request->notification_type)
            )
            ->when(
                $request->status,
                fn($q) =>
                $q->where('link_status', $request->status)
            )
            ->when(
                $request->search,
                fn($q) =>
                $q->where(function ($query) use ($request) {
                    $query->where('link_invoiceNo', 'like', "%{$request->search}%")
                        ->orWhere('link_name', 'like', "%{$request->search}%")
                        ->orWhere('link_amount', 'like', "%{$request->search}%");
                })
            )
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('Admin.links.index', compact('links'));
    }

    public function show(Request $request)
    {
        $id = $request->id;
        $data = Links::where("id", $id)->orderBy('created_at', 'desc')->get()->toArray();
        $sms = $data[0];
        $tnx = Tnx::find($id);
        $exists = !is_null($tnx);
        //dd($exists);
        return view('Admin.links.detail', compact('sms', 'exists'));
    }

    public function resent(Request $request)
    {
        $link_id = $request->id;
        $link = Links::where('id', $link_id)->first();
        $method = $link['link_type'];
        $Merchant = Merchants::where('merchant_id', $link['merchant_id'])->select('merchant_name', 'merchant_Cemail', 'merchant_address')->first();
        $id = $link['merchant_id'];
        $Sendername = $Merchant['merchant_name'];
        if ($method == 'S') {
            $message =
                " \n Invoice Number: " . $link['invoiceNo'] .
                " \n Amount: " . $link['amount'] . $link['currency'] .
                " \n From: " . $Sendername .
                "\n This is Your Payment Link : " . $link['link_url'];
            $phoneNumber = $link['link_phone'];
            $this->SMSService->sendSMS($phoneNumber, $message, $id);
        }
        if ($method == 'E') {
            $message = [
                $link['link_invoiceNo'],
                $link['link_amount'],
                $link['link_currency'],
                $Sendername,
                $link['link_url'],
            ];
            $details = [
                'subject' => 'Octoverse Payment Link',
                'merchant_name' => $Sendername,
                'merchant_Cemail' => $Merchant['merchant_Cemail'],
                'merchant_address' => $Merchant['merchant_address'],
                'expired_at' => $link['expired_at'],
                'remark' => $link['link_description'] ?? 'N/A',
            ];
            $email = $link['link_email'];
            // dd($message,$details,$email,$link);
            $this->SMSService->sendEmail($email, 'Octoverse Payment Link', $message, $details);
        }
        $notifatcion = '';
        if ($method == 'S') {
            $notifatcion = 'SMS';
        };
        if ($method == 'E') {
            $notifatcion = 'Email';
        };
        if ($method == 'C') {
            $notifatcion = 'Copy';
        };
        if ($method == 'Q') {
            $notifatcion = 'QR';
        };

        return back()
            ->with('success', true)
            ->with('link_url', $link['link_url'])
            ->with($notifatcion, true);
    }

    public function exportCsv(Request $request)
    {
        return Excel::download(
            new AllMerchantLinksExport($request->all()),
            'links' . now()->format('Y-m-d_H-i-s') . '.csv',
            \Maatwebsite\Excel\Excel::CSV
        );
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(
            new AllMerchantLinksExport($request->all()),
            'links' . now()->format('Y-m-d_H-i-s') . '.xlsx'
        );
    }


    public function edit($id)
    {
        $link = Links::findOrFail($id);
        $sms = sms::where('merchant_id', $link['created_by'])->get();
        return view('Admin.links.edit', compact('link', 'sms'));
    }

    public function update(LinkUpdateRequest $request, $id)
    {
        $link = Links::findOrFail($id);
        $validatedData = $request->validated();
        $link->update([
            'user_id'       => $validatedData['user_id'],
            'link_invoiceNo' => $validatedData['invoiceNo'],
            'link_amount'        => $validatedData['amount'],
            'link_name'          => $validatedData['name'],
            'link_phone'         => $validatedData['phone'],
            'link_email'         => $validatedData['email'],
            'link_expired_at'    => $validatedData['expired_at'],
            'link_description'   => $validatedData['description'],
            'link_type'  => $validatedData['notification'],
            'link_currency'      => $validatedData['currency'],
        ]);

        return to_route('admin.links')->with('Success', 'Link updated successfully.');
    }
}
