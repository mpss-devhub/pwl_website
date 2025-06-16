<?php

namespace App\Http\Controllers;

use App\Dao\LinkDao;
use App\Models\Links;
use App\Service\SMSService;
use Illuminate\Http\Request;
use App\Http\Requests\Merchant\LinkRequest;
use App\Models\Merchants;

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
        $linkUrl = $this->linkDao->create($request->validated());
        $Sendername = Merchants::where('user_id', $request->user_id)->select('merchant_name')->first();
        if ($request['notification'] == 'SMS') {
            $message =
                " \n Invoice Number: " . $request->invoiceNo .
                " \n Amount: " . $request->amount . $request->currency .
                " \n From: " . $Sendername['merchant_name'] .
                "\n This is Your Payment Link : " . $linkUrl;
            $phoneNumber = $request->phone;
            $this->SMSService->sendSMS($request->phone, message: $message);
        }
        if ($request['notification'] == 'Email') {
            $message = " \n Invoice Number: " . $request->invoiceNo .
                " \n Amount: " . $request->amount . $request->currency .
                " \n From: " . $Sendername['merchant_name'] .
                "\n This is Your Payment Link : " . $linkUrl;
            $email = $request->email;
            $this->SMSService->sendEmail($email, subject: 'Payment Link', message: $message);
        }
        $linkUrl = Links::where("link_invoiceNo", $request->invoiceNo)->select('link_url')->first();
        //dd($linkUrl['link_url']);
        return back()
            ->with('success', 'This is your link:')
            ->with('link_url', $linkUrl['link_url']);
    }


    public function show($token)
    {
        $data = $this->linkDao->getByToken($token);
        $details = $data[0][0]->toArray();
        $links = $data[1][0]->toArray();
        //dd($links['link_name']);

        return view('checkout.checkout', compact('details', 'links'));
    }
}
