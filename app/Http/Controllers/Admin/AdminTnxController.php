<?php

namespace App\Http\Controllers\Admin;

use App\Models\Click_Logs;
use App\Models\Tnx;
use App\Models\Links;
use App\Models\Merchants;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AllMerchantTransactionsExport;

class AdminTnxController extends Controller
{
    //

    public function show()
    {
        $tnx = Tnx::latest()->get();
        $Success = Tnx::where('payment_status', 'SUCCESS')->count();
        $total = Tnx::count();
        $Fail = Tnx::where('payment_status', 'FAIL')->count();
        $SuccessTotal = Tnx::where('payment_status', 'SUCCESS')->sum('req_amount');

        return view('Admin.tnx.index', compact('tnx', 'Success', 'total', 'Fail', 'SuccessTotal'));
    }

    public function exportCsv()
    {
        return Excel::download(new AllMerchantTransactionsExport, 'transactions.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    public function exportExcel()
    {
        return Excel::download(new AllMerchantTransactionsExport, 'transactions.xlsx');
    }

     public function detail(Request $request)
    {
        $id = $request->id;
        $links = $this->linkData($id);
        $m_id = $links['merchant_id'];
        $click = Click_Logs::where('link_id', $links['id'])->get();
        $info= $click[0]['info'];
        return view("Admin.tnx.detail",compact('links','m_id','id','click','info'));
    }
    private function linkData($id){
        $link = Tnx::where("id", $id)->select('link_id')->first();
        $link_info = Links::where('id',$link['link_id'])->get()->toArray();
        $links = $link_info[0];
        return $links;
    }

     public function paymentdetail(Request $request){
            $id = $request->id;
            $data = $this->getData($id);
            return view('Admin.tnx.payment',compact('data','id'));
    }

    private function getData($id)
    {
        $data = Tnx::where("id", $id)->first();
        return $data;
    }

}
