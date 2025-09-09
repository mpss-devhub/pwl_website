<?php

namespace App\Http\Controllers;

use App\Dao\LinkDao;
use App\Models\Links;
use App\Models\Merchants;
use App\Models\Tnx;
use App\Models\Click_Logs;
use App\Service\SMSService;
use App\Imports\LinksImport;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\LinkUpdateRequest;
use App\Http\Requests\Merchant\LinkRequest;
use App\Models\sms;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Maatwebsite\Excel\Validators\ValidationException;

class LinksController extends Controller
{
    //
    protected SMSService $SMSService;
    protected LinkDao $linkDao;

    public function __construct(LinkDao $linkDao, SMSService $SMSService)
    {
        $this->SMSService = $SMSService;
        $this->linkDao = $linkDao;
    }

    public function store(LinkRequest $request)
    {
        //dd($request->validated());
        $linkUrl = $this->linkDao->create($request->validated());
        $Sendername = Merchants::where('user_id', $request->user_id)->select('merchant_Cemail', 'merchant_address', 'merchant_name', 'merchant_id')->first();
        $id = $Sendername['merchant_id'];
        if ($request['notification'] == 'SMS') {
            $message =
                " \n Invoice Number: " . $request->invoiceNo .
                " \n Amount: " . $request->amount . $request->currency .
                " \n From: " . $Sendername['merchant_name'] .
                "\n This is Your Payment Link : " . $linkUrl;
            $phoneNumber = $request->phone;
            $this->SMSService->sendSMS($request->phone, $message, $id);
        }
        if ($request['notification'] == 'Email') {
            $linkUrl = Links::where("link_invoiceNo", $request->invoiceNo)->value('link_url');
            $message = [
                $request->invoiceNo,
                $request->amount,
                $request->currency,
                $Sendername['merchant_name'],
                $linkUrl,
            ];
            $details = [
                'subject' => 'Octoverse Payment Link',
                'merchant_name' => $Sendername['merchant_name'],
                'merchant_Cemail' => $Sendername['merchant_Cemail'],
                'merchant_address' => $Sendername['merchant_address'],
                'expired_at' => $request->expired_at,
                'remark' => $request->description ?? 'N/A',
            ];
            $email = $request->email;
            $this->SMSService->sendEmail($email, 'Octoverse Payment Link', $message, $details);
        }

        $linkUrl = Links::where("link_invoiceNo", $request->invoiceNo)->select('link_url')->first();
        return back()
            ->with('success', true)
            ->with('link_url', $linkUrl['link_url'])
            ->with($request['notification'], true);
    }


    public function show($token)
    {
        $data = $this->linkDao->getByToken($token);
        if (!$data) {
            Links::where('link_url', url("/pay/" . $token))->update(['link_status' => 'expired']);
            return response()->view('Extra.expired', [], 410);
        }
        [$details, $link] = $data;
        $details = $details->toArray();
        $link = $link[0];
        $links = $link->toArray();
        $status = Tnx::where('link_id', $links['id'])->select('payment_status')->first();
        if ($status == null) {
            $this->click($links['id']);
            return view('checkout.checkout', compact('details', 'links'));
        }
        $link = Links::where('id', $links['id'])->firstOrFail();
        $tnx = Tnx::where('link_id', $links['id'])->latest()->firstOrFail();
        $merchant = Merchants::where('user_id', $links['user_id'])->firstOrFail();

        //Check Status If The Link is Reclick
        if ($status['payment_status'] == 'SUCCESS') {
            return view('Extra.success', compact('merchant', 'link', 'tnx'));
        }
        if ($status['payment_status'] == 'FAIL') {
            return view('Extra.fail', compact('merchant', 'link', 'tnx'));
        }
        if ($status['payment_status'] == 'PENDING') {
            Tnx::where('link_id', $links['id'])->update([
                'payment_status' => 'FAIL'
            ]);
             $link = Links::where('id', $links['id'])->update([
                'link_status' => 'expired'
            ]);;
             return view('Extra.fail', compact('merchant', 'link', 'tnx'));
        }
    }


    private function click($id)
    {
        $ip = '103.105.172.32'; // For testing purposes, can replace this with a real IP address.
        $ip = request()->ip();
        if ($ip === '127.0.0.1') {
            $info = null;
        } else {
            $response = Http::get("http://ipwhois.app/json/{$ip}");
            if ($response->successful()) {
                $data = $response->json();
                $info = [
                    'country'        => $data['country'] ?? null,
                    'country_code'   => $data['country_code'] ?? null,
                    'provider'       => $data['isp'] ?? null,
                    'country_phone'  => $data['country_phone'] ?? null,
                    'country_flag'   => $data['country_flag'] ?? null,
                    'region'         => $data['region'] ?? null,
                    'city'           => $data['city'] ?? null,
                ];
            } else {
                $info = ['error' => 'IP info fetch failed'];
            }
        }
        $clickLog = Click_Logs::firstOrCreate(
            [
                'link_id'     => $id,
                'ip_address'  => $ip,
            ],
            [
                'info'        => $info,
                'created_at'  => now(),
            ]
        );
        if ($clickLog->wasRecentlyCreated) {
            Links::where('id', $id)->update([
                'link_click_status' => 'Clicked',
            ]);
        }
    }

    public function bundle()
    {
        return view('Merchant.Bundle.bundle');
    }


    public function edit($id)
    {
        $link = Links::findOrFail($id);
        $sms = sms::where('merchant_id', $link['created_by'])->get();
        return view('Merchant.sms.edit', compact('link', 'sms'));
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
            'expired_at'    => $validatedData['expired_at'],
            'link_description'   => $validatedData['description'],
            'link_type'  => $validatedData['notification'],
            'link_currency'      => $validatedData['currency'],
        ]);

        return to_route('merchant.sms')->with('Success', 'Link updated successfully.');
    }

    public function importLinks(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx',
        ]);

        try {
            $import = new LinksImport(app(SMSService::class));
            Excel::import($import, $request->file('excel_file'));

            if ($import->getSuccessCount() === 0) {
                //  dd('pass');
                return back()->withErrors(['import' => 'No rows were imported. Please check for validation errors or duplicates.']);
            }

            return back()->with('success', $import->getSuccessCount() . ' payment links generated successfully!');
        } catch (ValidationException $e) {
            $messages = [];

            foreach ($e->failures() as $failure) {
                $row = $failure->row();
                $errors = implode(', ', $failure->errors());
                $messages[] = "Row {$row}: {$errors}";
            }

            return back()->withErrors($messages);
        } catch (\Throwable $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
