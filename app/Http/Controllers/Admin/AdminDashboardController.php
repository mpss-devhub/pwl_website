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
    public function index(Request $request)
    {
        $year = $request->get('year', 'all');
        $month = $request->get('month', 'all');

        $totalUsers = User::where('role', 'admin')->count();
        $activeMerchants = Merchants::where('status', 'on')->count();
        $latestTransactions = $this->getLatestTransactions();
        $totalTransactionAmount = Tnx::where('payment_status', 'SUCCESS')->where('currencyCode', 'MMK')->sum('net_amount');
        $totalTransactionAmountUSD = Tnx::where('payment_status', 'SUCCESS')->where('currencyCode', 'USD')->sum('net_amount');
        $totalTransactions = Tnx::count();

        $revenueData = $this->getRevenueData($year, $month);
        $userGrowthData = $this->getUserGrowthData($year, $month);

        $recentActivities = Tnx::with('merchant')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $quickStats = [
            'new_users'           => User::whereDate('created_at', Carbon::today())->count(),
            'todays_transactions' => Tnx::whereDate('created_at', Carbon::today())->sum('net_amount'),
            'todays_sms'          => Links::whereDate('created_at', Carbon::today())->count(),
            'pending_payments'    => Tnx::where('payment_status', 'Pending')->count()
        ];

        return view('Admin.index', compact(
            'totalUsers',
            'activeMerchants',
            'totalTransactionAmount',
            'totalTransactionAmountUSD',
            'totalTransactions',
            'revenueData',
            'userGrowthData',
            'recentActivities',
            'quickStats',
            'latestTransactions',
            'year',
            'month'
        ));
    }

    private function getLatestTransactions($limit = 5)
    {
        return Tnx::with('merchant', 'link')
            ->where('payment_status', 'Success')
            ->latest()
            ->take($limit)
            ->get();
    }

    private function getRevenueData($year, $month)
    {
        if ($year === 'all' && $month === 'all') {
            // Show past 5 years
            $currentYear = Carbon::now()->year;
            $startYear = $currentYear - 5;

            $revenue = Tnx::selectRaw('YEAR(created_at) as year, SUM(net_amount) as total')
                ->whereYear('created_at', '>=', $startYear)
                ->where('currencyCode', 'MMK')
                ->where('payment_status', 'SUCCESS')
                ->groupBy('year')
                ->orderBy('year')
                ->pluck('total', 'year')
                ->toArray();

            $labels = [];
            $values = [];
            for ($y = $startYear; $y <= $currentYear; $y++) {
                $labels[] = (string) $y;
                $values[] = isset($revenue[$y]) ? (float) $revenue[$y] : 0;
            }
        } elseif ($month === 'all') {

            $revenue = Tnx::selectRaw('MONTH(created_at) as month, SUM(net_amount) as total')
                ->whereYear('created_at', $year)
                ->where('payment_status', 'SUCCESS')
                ->groupBy('month')
                ->pluck('total', 'month')
                ->toArray();

            $labels = [];
            $values = [];
            for ($m = 1; $m <= 12; $m++) {
                $labels[] = Carbon::create()->month($m)->format('M');
                $values[] = isset($revenue[$m]) ? (float) $revenue[$m] : 0;
            }
        } else {

            $daysInMonth = Carbon::create($year, $month, 1)->daysInMonth;
            $revenue = Tnx::selectRaw('DAY(created_at) as day, SUM(net_amount) as total')
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->where('payment_status', 'SUCCESS')
                ->groupBy('day')
                ->pluck('total', 'day')
                ->toArray();

            $labels = [];
            $values = [];
            for ($d = 1; $d <= $daysInMonth; $d++) {
                $labels[] = (string)$d;
                $values[] = isset($revenue[$d]) ? (float) $revenue[$d] : 0;
            }
        }

        return [
            'labels' => $labels,
            'data'   => $values,
        ];
    }

    private function getUserGrowthData($year, $month)
    {
        if ($year === 'all' && $month === 'all') {
            // Show past 5 years
            $currentYear = Carbon::now()->year;
            $startYear = $currentYear - 5;

            $growth = Merchants::selectRaw('YEAR(created_at) as year, COUNT(*) as total')
                ->whereYear('created_at', '>=', $startYear)
                ->groupBy('year')
                ->orderBy('year')
                ->pluck('total', 'year')
                ->toArray();

            $labels = [];
            $values = [];
            for ($y = $startYear; $y <= $currentYear; $y++) {
                $labels[] = (string) $y;
                $values[] = isset($growth[$y]) ? (int) $growth[$y] : 0;
            }
        } elseif ($month === 'all') {

            $growth = Merchants::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                ->whereYear('created_at', $year)
                ->groupBy('month')
                ->pluck('total', 'month')
                ->toArray();

            $labels = [];
            $values = [];
            for ($m = 1; $m <= 12; $m++) {
                $labels[] = Carbon::create()->month($m)->format('M');
                $values[] = isset($growth[$m]) ? (int) $growth[$m] : 0;
            }
        } else {

            $daysInMonth = Carbon::create($year, $month, 1)->daysInMonth;
            $growth = Merchants::selectRaw('DAY(created_at) as day, COUNT(*) as total')
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->groupBy('day')
                ->pluck('total', 'day')
                ->toArray();

            $labels = [];
            $values = [];
            for ($d = 1; $d <= $daysInMonth; $d++) {
                $labels[] = (string)$d;
                $values[] = isset($growth[$d]) ? (int) $growth[$d] : 0;
            }
        }

        return [
            'labels' => $labels,
            'data'   => $values,
        ];
    }
}
