<?php

namespace App\Http\Controllers;

use App\Dao\LinkDao;
use App\Models\Links;
use App\Models\Merchants;
use App\Models\Click_Logs;
use App\Service\SMSService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Requests\Merchant\LinkRequest;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
        $Sendername = Merchants::where('user_id', $request->user_id)->select('merchant_name', 'merchant_id')->first();
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
            $message = " \n Invoice Number: " . $request->invoiceNo .
                " \n Amount: " . $request->amount . $request->currency .
                " \n From: " . $Sendername['merchant_name'] .
                "\n This is Your Payment Link : " . $linkUrl;
            $email = $request->email;
            $this->SMSService->sendEmail($email, subject: 'Payment Link', message: $message);
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
            return response()->view('Extra.expired', [], 410);
        }
        [$details, $link] = $data;
        $details = $data[0]->toArray();
        $links = $data[1][0]->toArray();
        $this->click($links['id']);
        //dd($links['id']);
        return view('checkout.checkout', compact('details', 'links'));
    }

    private function click($id){

        Click_Logs::updateOrCreate([
            'link_id'=> $id,
            'ip_address'=>'192.168.525',
            'info'=>'Clicked',
            'created_at'=>Carbon::now()
        ]);

        $link = Links::where('id', $id)->update([
            'link_click_status' => 'Clicked',
        ]);
    }
}
