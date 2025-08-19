<?php

namespace App\Http\Controllers\Merchant;

use App\Models\Tnx;
use App\Models\Links;
use App\Models\Merchants;
use App\Models\Click_Logs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TnxController extends Controller
{
    //
    public function index(Request $request)
    {
        //dd($request->all());
        $id = Auth::user()->user_id;
        $Merchant = Merchants::where('user_id', $id)->select('merchant_id')->first();
        $query = Tnx::where('created_by', $Merchant['merchant_id']);
        if ($request->filled('start_date')) {
            $query->where('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->where('created_at', '<=', $request->end_date);
        }
        if ($request->filled('payment_method')) {
            $query->where('paymentCode', $request->payment_method);
        }
        if ($request->filled('status')) {
            $query->where('payment_status', $request->status);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('tranref_no', 'like', "%$search%")
                    ->orWhere('payment_user_name', 'like', "%$search%")
                    ->orWhere('tnx_phonenumber', 'like', "%$search%")
                    ->orWhere('req_amount', 'like', "%$search%");
            });
        }
        $tnx = $query->latest()->paginate(10)->withQueryString();
        $paymentMethods = Tnx::select('paymentCode')->distinct()->get();
        return view('Merchant.tnx.transactions', compact('tnx','paymentMethods'));
    }

    public function detail(Request $request)
    {
        $id = $request->id;
        $links = $this->linkData($id);
        $click = Click_Logs::where('link_id', $links['id'])->get();
        $logo = Merchants::where('merchant_id', $links['created_by'])->select('merchant_logo')->first();
        //dd($id);
        return view("Merchant.tnx.detail", compact('links', 'logo', 'id', 'click'));
    }

    public function paymentdetail(Request $request)
    {
        $id = $request->id;
        $data = $this->getData($id);
        return view('Merchant.tnx.payment', compact('data', 'id'));
    }

    private function getData($id)
    {
        $data = Tnx::where("id", $id)->first();
        return $data;
    }

    private function linkData($id)
    {
        $link = Tnx::where("id", $id)->select('link_id')->first();
        $link_info = Links::where('id', $link['link_id'])->get()->toArray();
        $links = $link_info[0];
        return $links;
    }
}
