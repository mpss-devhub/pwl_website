<?php

namespace App\Http\Controllers;

use App\Http\Requests\MerchantRequest;
use App\Http\Requests\MerchantUpdateRequest;
use App\Models\Merchants;
use App\Models\User;
use Illuminate\Http\Request;
use App\Service\AdminService;
use App\Service\UserService;

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
        //dd($request->validated());
        $this->user_service->updateMerchant($request->validated());
        return redirect()->route('merchant.show')->with('success', 'Merchant updated successfully!');

    }

    public function mdr($id){
        dd('yes');
    }
}
