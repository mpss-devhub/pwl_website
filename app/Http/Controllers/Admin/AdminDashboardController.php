<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Tnx;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Links;
use App\Models\Merchants;

class AdminDashboardController extends Controller
{
    //
    public function index(Request $request)
    {
        $type = $request->get('filter', 'monthly');

        $totalUsers = User::count();

        $activeMerchants = Merchants::where('status', 'on')->count();

        $latestTransactions = $this->getLatestTransactions();

        $totalTransactionAmount = Tnx::sum('net_amount');

        $totalTransactions = Tnx::count();

        $revenueData = $this->getRevenueData($type);
    $userGrowthData = $this->getUserGrowthData($type);

        $recentActivities = Tnx::with('merchant')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $quickStats = [
            'new_users' => User::whereDate('created_at', Carbon::today())->count(),
            'todays_transactions' => Tnx::whereDate('created_at', Carbon::today())->sum('net_amount'),
            'todays_sms' => Links::whereDate('created_at', Carbon::today())->count(),
            'pending_payments' => Tnx::where('payment_status', 'Pending')->count()
        ];



        return view('Admin.index', compact(
            'totalUsers',
            'activeMerchants',
            'totalTransactionAmount',
            'totalTransactions',
            'revenueData',
            'userGrowthData',
            'recentActivities',
            'quickStats',
            'latestTransactions',
            'type'
        ));
    }

    private function getLatestTransactions($limit = 5)
    {
        return Tnx::with('merchant', 'link')
            ->latest()
            ->take($limit)
            ->get();
    }



private function getRevenueData($type = 'monthly')
{
    $now = Carbon::now();

    if ($type === 'daily') {
        // Last 30 days
        $startDate = $now->copy()->subDays(29)->startOfDay();

        // Query aggregated by day
        $data = DB::table('tnxes')
            ->selectRaw('DATE(created_at) as day, DATE_FORMAT(created_at, "%d %b %Y") as label, SUM(net_amount) as total')
            ->where('created_at', '>=', $startDate)
            ->groupBy('day', 'label')
            ->orderBy('day')
            ->get();

        // Prepare a list of all days in the period
        $period = [];
        for ($date = $startDate->copy(); $date->lte($now); $date->addDay()) {
            $period[$date->format('Y-m-d')] = $date->format('d M Y');
        }

        // Map data totals keyed by date
        $mapped = $data->keyBy('day')->map->total->toArray();

    } elseif ($type === 'yearly') {
        // Last 5 years including current
        $startYear = $now->year - 4;

        $data = DB::table('tnxes')
            ->selectRaw('YEAR(created_at) as year, SUM(net_amount) as total')
            ->whereYear('created_at', '>=', $startYear)
            ->groupBy('year')
            ->orderBy('year')
            ->get();

        // Prepare all years for the period
        $period = [];
        for ($year = $startYear; $year <= $now->year; $year++) {
            $period[$year] = (string)$year;
        }

        // Map data totals keyed by year
        $mapped = $data->keyBy('year')->map->total->toArray();

    } else {
        // Default monthly - last 12 months
        $startDate = $now->copy()->subMonths(11)->startOfMonth();

        $data = DB::table('tnxes')
            ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, DATE_FORMAT(created_at, "%b %Y") as label, SUM(net_amount) as total')
            ->where('created_at', '>=', $startDate)
            ->groupBy('year', 'month', 'label')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        // Prepare all months in the period
        $period = [];
        $tempDate = $startDate->copy();
        while ($tempDate->lte($now)) {
            $key = $tempDate->format('Y-m');
            $period[$key] = $tempDate->format('M Y');
            $tempDate->addMonth();
        }

        // Map data totals keyed by year-month string
        $mapped = [];
        foreach ($data as $row) {
            $key = $row->year . '-' . str_pad($row->month, 2, '0', STR_PAD_LEFT);
            $mapped[$key] = $row->total;
        }
    }

    // Build final arrays with zeros for missing data
    $labels = [];
    $values = [];
    foreach ($period as $key => $label) {
        $labels[] = $label;
        $values[] = $mapped[$key] ?? 0;
    }

    return [
        'labels' => $labels,
        'data' => $values,
    ];
}

private function getUserGrowthData($type = 'monthly')
{
    $now = Carbon::now();

    if ($type === 'daily') {
        $startDate = $now->copy()->subDays(29)->startOfDay();

        $data = Merchants::selectRaw('DATE(created_at) as day, DATE_FORMAT(created_at, "%d %b %Y") as label, COUNT(*) as count')
            ->where('created_at', '>=', $startDate)
            ->groupBy('day', 'label')
            ->orderBy('day')
            ->get();

        $period = [];
        for ($date = $startDate->copy(); $date->lte($now); $date->addDay()) {
            $period[$date->format('Y-m-d')] = $date->format('d M Y');
        }

        $mapped = $data->keyBy('day')->map->count->toArray();

    } elseif ($type === 'weekly') {
        $startDate = $now->copy()->subWeeks(12)->startOfWeek(Carbon::MONDAY);

        $data = Merchants::selectRaw('YEAR(created_at) as year, WEEK(created_at, 1) as week, CONCAT(YEAR(created_at), "-W", LPAD(WEEK(created_at, 1), 2, "0")) as label, COUNT(*) as count')
            ->where('created_at', '>=', $startDate)
            ->groupBy('year', 'week', 'label')
            ->orderBy('year')
            ->orderBy('week')
            ->get();

        $period = [];
        $tempDate = $startDate->copy();
        while ($tempDate->lte($now)) {
            $weekNum = $tempDate->weekOfYear;
            $label = $tempDate->format('Y') . '-W' . str_pad($weekNum, 2, '0', STR_PAD_LEFT);
            $period[$label] = $label;
            $tempDate->addWeek();
        }

        $mapped = $data->keyBy('label')->map->count->toArray();

    } elseif ($type === 'yearly') {
        $startYear = $now->year - 4;

        $data = Merchants::selectRaw('YEAR(created_at) as year, COUNT(*) as count')
            ->whereYear('created_at', '>=', $startYear)
            ->groupBy('year')
            ->orderBy('year')
            ->get();

        $period = [];
        for ($year = $startYear; $year <= $now->year; $year++) {
            $period[$year] = (string)$year;
        }

        $mapped = $data->keyBy('year')->map->count->toArray();

    } else {
        // monthly
        $startDate = $now->copy()->subMonths(11)->startOfMonth();

        $data = Merchants::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, DATE_FORMAT(created_at, "%b %Y") as label, COUNT(*) as count')
            ->where('created_at', '>=', $startDate)
            ->groupBy('year', 'month', 'label')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $period = [];
        $tempDate = $startDate->copy();
        while ($tempDate->lte($now)) {
            $key = $tempDate->format('Y-m');
            $period[$key] = $tempDate->format('M Y');
            $tempDate->addMonth();
        }

        $mapped = [];
        foreach ($data as $row) {
            $key = $row->year . '-' . str_pad($row->month, 2, '0', STR_PAD_LEFT);
            $mapped[$key] = $row->count;
        }
    }

    $labels = [];
    $values = [];
    foreach ($period as $key => $label) {
        $labels[] = $label;
        $values[] = $mapped[$key] ?? 0;
    }

    return [
        'labels' => $labels,
        'data' => $values,
    ];
}



}
