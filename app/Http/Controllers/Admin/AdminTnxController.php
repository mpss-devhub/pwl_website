<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Links;
use App\Models\Tnx;
use Illuminate\Http\Request;

class AdminTnxController extends Controller
{
    //

    public function show(){
        $tnx = Tnx::
        select('link_id','paymentCode','payment_status','updated_at','created_by','req_amount','currencyCode','payment_user_name','payment_logo','tranref_no')
        ->get();
        $Success = Tnx::where('payment_status','SUCCESS')->count();
       $total = Tnx::count();
        $Fail = Tnx::where('payment_status','FAIL')->count();
        $SuccessTotal = Tnx::where('payment_status','SUCCESS')->sum('req_amount');

        return view('Admin.tnx.index',compact('tnx','Success','total','Fail','SuccessTotal'));
    }


}
