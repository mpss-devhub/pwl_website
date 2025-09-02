<?php

namespace App\Http\Controllers\Merchant;

use Carbon\Carbon;
use App\Models\Tnx;
use App\Models\Links;
use App\Models\Merchants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MerchantDashboardController extends Controller
{
    public function show(Request $request)
    {
        $year = $request->get('year', 'all');
        $month = $request->get('month', 'all');
        $merchantId = $this->getMerchantId();
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $TotalMMK = $this->totalMMK($merchantId);
        $TotalUSD = $this->totalUSD($merchantId);
        $TotalSuccess = $this->totalSuccess($merchantId, $currentMonth, $currentYear);
        $TotalPending = $this->totalPending($merchantId, $currentMonth, $currentYear);
        $TotalFailed = $this->totalFailed($merchantId, $currentMonth, $currentYear);

        $Totallink = $this->TotalLink($merchantId);
        $Latest = $this->Latest($merchantId);
        $TotalTnx = $this->TotalTnx($merchantId);
        $Mostuse = $this->MostUsed($merchantId);

        $revenueData = $this->getRevenueDataByFilter($year, $month, $merchantId);

        $SuccessRate = $Totallink > 0 ? ($TotalSuccess / $Totallink) * 100 : 0;

        return view('Merchant.index', compact(
            'revenueData',
            'TotalMMK',
            'TotalUSD',
            'TotalSuccess',
            'TotalFailed',
            'TotalPending',
            'Totallink',
            'Latest',
            'TotalTnx',
            'Mostuse',
            'SuccessRate'
        ));
    }


    private function getMerchantId()
    {
        $id = auth()->user()->user_id;
        return Merchants::where('user_id', $id)->value('merchant_id');
    }

    private function getRevenueDataByFilter($year, $month, $merchantId)
    {
        $labels = [];
        $values = [];

        if (!$merchantId) {
            return ['labels' => $labels, 'data' => $values];
        }

        $query = Tnx::where('created_by', $merchantId)
            ->where('payment_status', 'SUCCESS');

        if ($year === 'all' && $month === 'all') {
            // Past 5 years including current year
            $currentYear = now()->year;
            $startYear = $currentYear - 5;

            $revenue = $query->selectRaw('YEAR(created_at) as year, SUM(net_amount) as total')
                ->whereYear('created_at', '>=', $startYear)
                ->groupBy('year')
                ->pluck('total', 'year')
                ->toArray();

            for ($y = $startYear; $y <= $currentYear; $y++) {
                $labels[] = (string)$y;
                $values[] = $revenue[$y] ?? 0;
            }
        } elseif ($year !== 'all' && $month === 'all') {

            $revenue = $query->selectRaw('MONTH(created_at) as month, SUM(net_amount) as total')
                ->whereYear('created_at', $year)
                ->groupBy('month')
                ->pluck('total', 'month')
                ->toArray();

            for ($m = 1; $m <= 12; $m++) {
                $labels[] = Carbon::createFromDate($year, $m, 1)->format('M');
                $values[] = $revenue[$m] ?? 0;
            }
        } elseif ($year !== 'all' && $month !== 'all') {

            $daysInMonth = Carbon::createFromDate($year, $month, 1)->daysInMonth;

            $revenue = $query->selectRaw('DAY(created_at) as day, SUM(net_amount) as total')
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->groupBy('day')
                ->pluck('total', 'day')
                ->toArray();

            for ($d = 1; $d <= $daysInMonth; $d++) {
                $labels[] = (string)$d;
                $values[] = $revenue[$d] ?? 0;
            }
        }
        return [
            'labels' => $labels,
            'data'   => $values,
        ];
    }



    private function TotalMMK($id)
    {
        $query = Tnx::where('created_by', $id)
            ->where('currencyCode', 'MMK')
            ->where('payment_status', 'SUCCESS');


        return $query->sum('net_amount');
    }

    private function TotalUSD($id)
    {
        $query = Tnx::where('created_by', $id)
            ->where('currencyCode', 'USD')
            ->where('payment_status', 'SUCCESS');


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
            ->select('paymentCode', 'tranref_no', 'req_amount', 'currencyCode', 'payment_status', 'created_by')
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
