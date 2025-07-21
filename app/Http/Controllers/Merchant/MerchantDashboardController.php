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
public function show(Request $request)
{
    $merchantId = $this->getMerchantId();
    $filter = $request->get('filter', 'monthly');

    $currentMonth = now()->month;
    $currentYear = now()->year;

    $TotalMMK = $this->totalMMK($merchantId, $currentMonth, $currentYear);
    $TotalSuccess = $this->totalSuccess($merchantId, $currentMonth, $currentYear);
    $TotalPending = $this->totalPending($merchantId, $currentMonth, $currentYear);
    $TotalFailed = $this->totalFailed($merchantId, $currentMonth, $currentYear);

    $Totallink = $this->TotalLink($merchantId);
    $Latest = $this->Latest($merchantId);
    $TotalTnx = $this->TotalTnx($merchantId);
    $Mostuse = $this->MostUsed($merchantId);

    $revenueData = $this->getRevenueDataByFilter($merchantId, $filter);

    $SuccessRate = $Totallink > 0 ? ($TotalSuccess / $Totallink) * 100 : 0;

    return view('Merchant.index', compact(
        'revenueData', 'TotalMMK', 'TotalSuccess',
        'TotalFailed', 'TotalPending', 'Totallink',
        'Latest', 'TotalTnx', 'Mostuse', 'SuccessRate', 'filter'
    ));
}


    private function getMerchantId()
    {
        $id = auth()->user()->user_id;
        return Merchants::where('user_id', $id)->value('merchant_id');
    }

private function getRevenueDataByFilter($merchantId, $filter = 'monthly')
{
    $query = Tnx::where('created_by', $merchantId)
                ->where('currencyCode', 'MMK')
                ->where('payment_status', 'SUCCESS');

    switch ($filter) {
        case 'weekly':
            // Get all weeks of the current year (1-52 or 53)
            $year = now()->year;
            $allWeeks = [];
            for ($week = 1; $week <= 53; $week++) {
                $allWeeks[$week] = "$year-W" . str_pad($week, 2, '0', STR_PAD_LEFT);
            }

            $data = $query->selectRaw('
                YEAR(created_at) as year,
                WEEK(created_at, 1) as week,
                CONCAT(YEAR(created_at), "-W", LPAD(WEEK(created_at, 1), 2, "0")) as label,
                SUM(net_amount) as total
            ')
            ->whereYear('created_at', $year)
            ->groupBy('year', 'week', 'label')
            ->orderBy('year')
            ->orderBy('week')
            ->get();

            // Map DB data into a keyed array for easier merging
            $mappedData = [];
            foreach ($data as $item) {
                $mappedData[$item->week] = $item->total;
            }

            $finalLabels = [];
            $finalData = [];
            foreach ($allWeeks as $weekNum => $label) {
                $finalLabels[] = $label;
                $finalData[] = $mappedData[$weekNum] ?? 0;
            }
            break;

        case 'yearly':
            // Fetch distinct years from data
            $years = $query->selectRaw('YEAR(created_at) as year')
                ->groupBy('year')
                ->orderBy('year')
                ->pluck('year')
                ->toArray();

            // Or fallback to last 5 years for consistent display
            $currentYear = now()->year;
            $allYears = range($currentYear - 4, $currentYear);

            $data = $query->selectRaw('
                YEAR(created_at) as label,
                SUM(net_amount) as total
            ')
            ->groupBy('label')
            ->orderBy('label')
            ->get()
            ->keyBy('label');

            $finalLabels = [];
            $finalData = [];
            foreach ($allYears as $year) {
                $finalLabels[] = (string)$year;
                $finalData[] = isset($data[$year]) ? $data[$year]->total : 0;
            }
            break;

        case 'monthly':
        default:
            $year = now()->year;
            // All months labels
            $allMonths = [
                1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun',
                7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec'
            ];

            $data = $query->selectRaw('
                MONTH(created_at) as month,
                SUM(net_amount) as total
            ')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month');

            $finalLabels = [];
            $finalData = [];
            foreach ($allMonths as $monthNum => $label) {
                $finalLabels[] = $label;
                $finalData[] = isset($data[$monthNum]) ? $data[$monthNum]->total : 0;
            }
            break;
    }

    return [
        'labels' => $finalLabels,
        'data' => $finalData,
    ];
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
