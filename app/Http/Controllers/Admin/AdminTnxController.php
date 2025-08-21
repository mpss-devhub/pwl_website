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

    public function show(Request $request)
    {
        $query = Tnx::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id', $search)
                    ->orWhere('tranref_no', 'like', "%{$search}%")
                    ->orWhere('payment_user_name', 'like', "%{$search}%")
                    ->orWhere('tnx_phonenumber', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('payment_status', $request->status);
        }

        if ($request->filled('payment_method')) {
            $query->where('paymentCode', $request->payment_method);
        }

        if ($request->filled('start_date')) {
            $query->where('created_at', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->where('created_at', '<=', $request->end_date);
        }

        $tnx = $query->latest()->paginate(10)->appends($request->all());
        $Success = Tnx::where('payment_status', 'SUCCESS')->count();
        $total = Tnx::count();
        $Fail = Tnx::where('payment_status', 'FAIL')->count();
        $SuccessTotal = Tnx::where('payment_status', 'SUCCESS')->sum('req_amount');
        $paymentMethods = Tnx::select('paymentCode')->distinct()->get();
        return view('Admin.tnx.index', compact('tnx', 'Success', 'total', 'Fail', 'SuccessTotal','paymentMethods'));
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
        $info = $click[0]['info'];
        return view("Admin.tnx.detail", compact('links', 'm_id', 'id', 'click', 'info'));
    }
    private function linkData($id)
    {
        $link = Tnx::where("id", $id)->select('link_id')->first();
        $link_info = Links::where('id', $link['link_id'])->get()->toArray();
        $links = $link_info[0];
        return $links;
    }

    public function paymentdetail(Request $request)
    {
        $id = $request->id;
        $data = $this->getData($id);
        return view('Admin.tnx.payment', compact('data', 'id'));
    }

    private function getData($id)
    {
        $data = Tnx::where("id", $id)->first();
        return $data;
    }
}
