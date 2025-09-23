<?php

namespace App\Http\Controllers\Merchant;

use Carbon\Carbon;
use App\Models\Tnx;
use App\Models\Links;
use App\Models\Merchants;
use App\Service\SMSService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\sms;
use Illuminate\Support\Facades\Auth;

class SMSController extends Controller
{
    //
    protected SMSService $SMSService;

    public function __construct(SMSService $SMSService)
    {
        $this->SMSService = $SMSService;
    }

    public function index(Request $request)
    {
        $id = Auth::user()->user_id;
        $m_id = Merchants::where('user_id', $id)->value('merchant_id');

        $query = Links::where('created_by', $m_id)
            ->whereNotIn('id', function ($q) {
                $q->select('link_id')->from('tnxes');
            });

        // Convert datetime-local inputs to proper format
        if ($request->filled('start-date')) {
            $start = Carbon::parse($request->input('start-date'))->startOfDay();
            $query->where('created_at', '>=', $start);
        }

        if ($request->filled('end-date')) {
            $end = Carbon::parse($request->input('end-date'))->endOfDay();
            $query->where('created_at', '<=', $end);
        }

        if ($request->filled('notification-type')) {
            $query->where('link_type', $request->input('notification-type'));
        }

        if ($request->filled('status')) {
            $query->where('link_status', $request->input('status'));
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('link_invoiceNo', 'like', "%$search%")
                    ->orWhere('link_name', 'like', "%$search%")
                    ->orWhere('link_phone', 'like', "%$search%");
            });
        }

        $links = $query->latest('created_at')->paginate(10)->withQueryString();
        $merchant_id = Merchants::where('user_id',Auth::user()->user_id)->select('merchant_id')->first();
        $sms = sms::where('merchant_id', $merchant_id)->get();
        return view('Merchant.sms.index', compact('links','sms'));
    }


    public function show(Request $request)
    {
        $id = $request->id;
        $data = Links::where("id", $id)->orderBy('created_at', 'desc')->get()->toArray();
        $sms = $data[0];
        $tnx = Tnx::find($id);
        $exists = !is_null($tnx);
        //dd($exists);
        return view('Merchant.sms.detail', compact('sms', 'exists'));
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

        //dd($notifatcion);
        return back()
            ->with('success', true)
            ->with('link_url', $link['link_url'])
            ->with($notifatcion, true);
    }
}
