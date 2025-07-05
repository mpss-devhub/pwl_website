<?php

namespace App\Http\Controllers\Merchant;

use App\Models\Tnx;
use App\Models\Links;
use App\Models\Merchants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MerchantDashboardController extends Controller
{
    //
     public function show()
    {
        $id = $this->getMerchantId();
        $TotalMMK = $this->TotalMMK($id);
        $Totallink = $this->TotalLink($id);
        $TotalSuccess = $this->TotalSuccess($id);
        $TotalPending = $this->TotalPending($id);
        $TotalFailed = $this->TotalFailed($id);
        $Latest = $this->Latest($id);
        $TotalTnx = $this->TotalTnx($id);
        $Mostuse = $this->MostUsed($id);
        $SuccessRate = $Totallink > 0 ? ($TotalSuccess / $Totallink) * 100 : 0;
       // dd($SuccessRate);
        return view('merchant.index',compact('TotalMMK','TotalSuccess','TotalFailed','TotalPending','Totallink','Latest','TotalTnx','Mostuse','SuccessRate'));
    }

    private function getMerchantId()
    {
        $id = auth()->user()->user_id;
        return Merchants::where('user_id', $id)->value('merchant_id');
    }

    private function TotalMMK($id)
    {
        $TotalMMK = Tnx::where('created_by', $id)
            ->where('currencyCode', 'MMK')
            ->sum('net_amount');
        return $TotalMMK;
    }

    private function TotalLink($id)
    {
        $Totallink = Links::where('created_by', $id)
            ->count();
        return $Totallink;
    }

    private function TotalSuccess($id)
    {
        $TotalSuccess = Tnx::where('created_by', $id)
            ->where('payment_status', 'SUCCESS')
            ->count();
        return $TotalSuccess;
    }

     private function TotalPending($id)
    {
        $TotalPending = Tnx::where('created_by', $id)
            ->where('payment_status', 'Pending')
            ->count();

        return $TotalPending;
    }

    private function TotalFailed($id)
    {
        $TotalFailed = Tnx::where('created_by', $id)
            ->where('payment_status', 'FAIL')
            ->count();

        return $TotalFailed;
    }

    private function Latest($id)
    {
        $Latest = Tnx::where('created_by', $id)
            ->where('payment_status','SUCCESS')
            ->orderBy('created_at', 'desc')
            ->select('paymentCode', 'tranref_no', 'req_amount','currencyCode')
            ->take(5)
            ->get();
        return $Latest;
    }

    private function MostUsed($id)
    {
      $MostUsed = Tnx::where('created_by', $id)
        ->select('paymentCode', 'payment_logo', DB::raw('COUNT(*) as total'))
        ->groupBy('paymentCode', 'payment_logo')
        ->orderByDesc('total')
        ->take(5)
        ->get();
        return $MostUsed;
    }

    private function TotalTnx($id){
        $TotalTnx = Tnx::where('created_by', $id)->count();
        return $TotalTnx;
    }
}
