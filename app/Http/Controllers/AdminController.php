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
use App\Models\Tnx;

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

    public function index(Request $request)
    {
        $query = Merchants::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $type = $request->search_type ?? 'all';
            $columns = [
                'id' => 'merchant_id',
                'name' => 'merchant_name',
                'email' => 'merchant_Cemail',
                'phone' => 'merchant_Cphone',
                'contact_name' => 'merchant_Cname',
            ];

            if ($type === 'all') {
                $query->where(function ($q) use ($search) {
                    $q->where('merchant_id', 'like', "%{$search}%")
                        ->orWhere('merchant_name', 'like', "%{$search}%")
                        ->orWhere('merchant_Cemail', 'like', "%{$search}%")
                        ->orWhere('merchant_Cphone', 'like', "%{$search}%")
                        ->orWhere('merchant_Cname', 'like', "%{$search}%");
                });
            } elseif (isset($columns[$type])) {
                $query->where($columns[$type], 'like', "%{$search}%");
            }
        }
        if ($request->filled('active_status')) {
            $status = $request->active_status === 'on' ? 'on' : 'off';
            $query->where('status', $status);
        }

        $merchantInfo = $query->paginate(10)->withQueryString();

        return view('Admin.merchant.index', compact('merchantInfo'));
    }


    public function merchantdetail($id)
    {
        $details = Merchants::where('user_id', $id)->get()->all();
        return view('Admin.merchant.info', compact('details'));
    }


    public function update($id)
    {
        $details = Merchants::where('user_id', $id)->get()->all();
        $count = Tnx::where('created_by',$details[0]['merchant_id'])->count();
       // dd($count);
        return view('Admin.merchant.update', compact('details','count'));
    }

    public function merchantupdate(MerchantUpdateRequest $request)
    {
        //dd($request->validated());
        $this->user_service->updateMerchant($request->validated());
        return redirect()->route('merchant.show')->with('success', 'Merchant updated successfully!');
    }

    public function destory($id){
        Merchants::where('user_id',$id)->delete();
        User::where('user_id',$id)->delete();
        return to_route('merchant.show')->with('Success','Merchant Delete Successfully');
    }

    public function sms($id)
    {
        $details = Merchants::where('user_id', $id)->select('merchant_id')->first();
        $sms =  sms::where('merchant_id', $details->merchant_id)->select('id', 'sms_from', 'sms_url', 'sms_token')->get();
        //dd($sms);

        return view('Admin.sms.index', compact('details', 'sms'));
    }

    public function create(Request $request)
    {
        sms::updateOrCreate(
            ['merchant_id' => $request->merchant_id],
            [
                'sms_from' => $request->sender_name,
                'sms_token' => $request->api_token
            ]
        );
        return back()->with('success', 'SMS settings updated successfully!');
    }

    public function delete($id)
    {
        $sms = sms::findOrFail($id);
        $sms->delete();
        return back()->with('success', 'SMS settings deleted successfully!');
    }

    public function mdr($id)
    {
        $merchant = Merchants::where('user_id', $id)->value('merchant_id');
        // dd($merchant);
        $merchant = $this->admin_service->getMerchantList($merchant);
        $Ewallet = $merchant['data']['dataList'][0]['paymentMdrInfoList'][0]['payments'] ?? [];
        $QR = $merchant['data']['dataList'][0]['paymentMdrInfoList'][1]['payments'] ?? [];
        $Web = $merchant['data']['dataList'][0]['paymentMdrInfoList'][2]['payments'] ?? [];
        $L_C = $merchant['data']['dataList'][0]['paymentMdrInfoList'][3]['payments'] ?? [];
        $G_C = $merchant['data']['dataList'][0]['paymentMdrInfoList'][4]['payments'] ?? [];
        // dd($Ewallet, $QR, $Web, $L_C, $G_C);
        return view('Admin.mdr.mdr', compact('Ewallet', 'QR', 'Web', 'L_C', 'G_C'));
    }
}
