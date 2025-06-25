<?php

namespace App\Http\Controllers\Merchant;

use App\Models\Tnx;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Links;
use App\Models\Merchants;

class TnxController extends Controller
{
    //

    public function detail(Request $request)
    {
        $id = $request->id;
        $links = $this->linkData($id);
        $logo = Merchants::where('merchant_id',$links['created_by'])->select('merchant_logo')->first();
        //dd($id);
        return view("Merchant.tnx.detail",compact('links','logo','id'));
    }

    public function paymentdetail(Request $request){
            $id = $request->id;
            $data = $this->getData($id);
            return view('Merchant.tnx.payment',compact('data','id'));
    }

    private function getData($id)
    {
        $data = Tnx::where("id", $id)->first();
        return $data;
    }

    private function linkData($id){
        $link = Tnx::where("id", $id)->select('link_id')->first();
        $link_info = Links::where('id',$link['link_id'])->get()->toArray();
        $links = $link_info[0];
        return $links;
    }



}
