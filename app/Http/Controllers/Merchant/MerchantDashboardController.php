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
    public function show()
    {
        $id = $this->getMerchantId();
        $currentMonth = now()->month;
        $currentYear = now()->year;

        // Current month data
        $TotalMMK = $this->TotalMMK($id, $currentMonth, $currentYear);
        $TotalSuccess = $this->TotalSuccess($id, $currentMonth, $currentYear);
        $TotalPending = $this->TotalPending($id, $currentMonth, $currentYear);
        $TotalFailed = $this->TotalFailed($id, $currentMonth, $currentYear);

        // All-time data (not restricted to current month)
        $Totallink = $this->TotalLink($id);
        $Latest = $this->Latest($id);
        $TotalTnx = $this->TotalTnx($id);
        $Mostuse = $this->MostUsed($id);

        // Chart data (all months)
        $monthlyRevenue = $this->getMonthlyRevenue($id);

        $SuccessRate = $Totallink > 0 ? ($TotalSuccess / $Totallink) * 100 : 0;

        return view('merchant.index', compact(
            'monthlyRevenue', 'TotalMMK', 'TotalSuccess',
            'TotalFailed', 'TotalPending', 'Totallink',
            'Latest', 'TotalTnx', 'Mostuse', 'SuccessRate'
        ));
    }

    private function getMerchantId()
    {
        $id = auth()->user()->user_id;
        return Merchants::where('user_id', $id)->value('merchant_id');
    }

    private function getMonthlyRevenue($merchantId)
    {
        $year = date('Y');
        $monthlyRevenue = array_fill(1, 12, 0);

        $results = Tnx::where('created_by', $merchantId)
            ->where('currencyCode', 'MMK')
            ->whereYear('created_at', $year)
            ->selectRaw('MONTH(created_at) as month, SUM(net_amount) as total')
            ->groupBy('month')
            ->get();

        foreach ($results as $result) {
            $monthlyRevenue[$result->month] = (int)$result->total;
        }

        return array_values($monthlyRevenue);
    }

    private function TotalMMK($id, $month = null, $year = null)
    {
        $query = Tnx::where('created_by', $id)
            ->where('currencyCode', 'MMK')
            ->where('payment_status', 'SUCCESS');

        if ($month && $year) {
            $query->whereMonth('created_at', $month)
                  ->whereYear('created_at', $year);
        }

        return $query->sum('net_amount');
    }

    private function TotalLink($id)
    {
        return Links::where('created_by', $id)->count();
    }

    private function TotalSuccess($id, $month = null, $year = null)
    {
        $query = Tnx::where('created_by', $id)
            ->where('payment_status', 'SUCCESS');

        if ($month && $year) {
            $query->whereMonth('created_at', $month)
                  ->whereYear('created_at', $year);
        }

        return $query->count();
    }

    private function TotalPending($id, $month = null, $year = null)
    {
        $query = Tnx::where('created_by', $id)
            ->where('payment_status', 'Pending');

        if ($month && $year) {
            $query->whereMonth('created_at', $month)
                  ->whereYear('created_at', $year);
        }

        return $query->count();
    }

    private function TotalFailed($id, $month = null, $year = null)
    {
        $query = Tnx::where('created_by', $id)
            ->where('payment_status', 'FAIL');

        if ($month && $year) {
            $query->whereMonth('created_at', $month)
                  ->whereYear('created_at', $year);
        }

        return $query->count();
    }

    private function Latest($id)
    {
        return Tnx::where('created_by', $id)
            ->where('payment_status', 'SUCCESS')
            ->orderBy('created_at', 'desc')
            ->select('paymentCode', 'tranref_no', 'req_amount', 'currencyCode')
            ->take(5)
            ->get();
    }

    private function MostUsed($id)
    {
        return Tnx::where('created_by', $id)
            ->select('paymentCode', 'payment_logo', DB::raw('COUNT(*) as total'))
            ->groupBy('paymentCode', 'payment_logo')
            ->orderByDesc('total')
            ->take(5)
            ->get();
    }

    private function TotalTnx($id)
    {
        return Tnx::where('created_by', $id)->count();
    }
}
