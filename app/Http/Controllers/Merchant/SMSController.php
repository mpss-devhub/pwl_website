<?php

namespace App\Http\Controllers\Merchant;

use App\Models\Links;
use App\Service\SMSService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Merchants;
use App\Models\Tnx;

class SMSController extends Controller
{
    //
    protected SMSService $SMSService;

    public function __construct(SMSService $SMSService)
    {
        $this->SMSService = $SMSService;
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
        $Merchant = Merchants::where('merchant_id', $link['merchant_id'])->select('merchant_name','merchant_Cemail','merchant_address')->first();
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
