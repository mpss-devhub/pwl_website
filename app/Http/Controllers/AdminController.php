<?php

namespace App\Http\Controllers;

use App\Models\sms;
use App\Models\User;
use App\Models\Merchants;
use App\Service\SMSService;
use App\Service\UserService;
use Illuminate\Http\Request;
use App\Service\AdminService;
use App\Http\Requests\MerchantRequest;
use App\Http\Requests\MerchantUpdateRequest;

class AdminController extends Controller
{
    //
    protected AdminService $admin_service;
    protected UserService $user_service;

    public function __construct(AdminService $admin_service, UserService $user_service)
    {
        $this->admin_service = $admin_service;
        $this->user_service = $user_service;
    }

    public function index()
    {
        $merchantInfo =  Merchants::paginate(10);
        return view('Admin.merchant.index', compact('merchantInfo'));
    }

    public function merchantdetail($id)
    {
        $details = Merchants::where('user_id',$id)->get()->all();
        return view('Admin.merchant.info',compact('details'));
    }


    public function update($id)
    {
        $details = Merchants::where('user_id',$id)->get()->all();
        return view('Admin.merchant.update',compact('details'));
    }

    public function merchantupdate(MerchantUpdateRequest $request)
    {
        $this->user_service->updateMerchant($request->validated());
        return redirect()->route('merchant.show')->with('success', 'Merchant updated successfully!');

    }

    public function mdr($id){
        dd('yes');
    }


    public function sms($id){
         $details = Merchants::where('user_id',$id)->select('merchant_id')->first();
         $sms =  sms::where('merchant_id',$details->merchant_id)->select('id','sms_from', 'sms_url', 'sms_token')->get();
        //dd($sms);

        return view('Admin.sms.index',compact('details', 'sms'));
    }

    public function create(Request $request)
    {
       //dd($request->sender_name, $request->api_url, $request->api_token);
      sms::updateOrCreate(
        ['merchant_id' => $request->merchant_id], // Condition
        [
            'sms_from' => $request->sender_name,
            'sms_url' => $request->api_url,
            'sms_token' => $request->api_token
        ] // Data to update or insert
    );
    return back()->with('success', 'SMS settings updated successfully!');

    }

    public function delete($id)
    {
        $sms = sms::findOrFail($id);
        $sms->delete();
        return back()->with('success', 'SMS settings deleted successfully!');
    }

}
