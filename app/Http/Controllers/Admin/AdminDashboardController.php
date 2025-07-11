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
    public function index()
    {
        $totalUsers = User::count();

        $activeMerchants = Merchants::where('status', 'on')->count();

        $latestTransactions = $this->getLatestTransactions();

        $totalTransactionAmount = Tnx::sum('net_amount');

        $totalTransactions = Tnx::count();

        $revenueData = $this->getRevenueData();

        $userGrowthData = $this->getUserGrowthData();

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
            'latestTransactions'
        ));
    }

    private function getLatestTransactions($limit = 5)
    {
        return Tnx::with('merchant', 'link')
            ->latest()
            ->take($limit)
            ->get();
    }




    private function getRevenueData()
    {
        $revenue = Tnx::select(
            DB::raw('SUM(net_amount) as total'),
            DB::raw("DATE_FORMAT(created_at, '%b') as month"),
            DB::raw("MONTH(created_at) as month_num")
        )
            ->where('created_at', '>=', Carbon::now()->subMonths(12))
            ->groupBy('month', 'month_num')
            ->orderBy('month_num')
            ->get();

        $allMonths = [];
        for ($i = 0; $i < 12; $i++) {
            $month = Carbon::now()->subMonths(11 - $i)->format('M');
            $allMonths[$month] = 0;
        }

        foreach ($revenue as $item) {
            $allMonths[$item->month] = $item->total;
        }

        return [
            'labels' => array_keys($allMonths),
            'data' => array_values($allMonths)
        ];
    }


    private function getUserGrowthData()
    {
        $users = Merchants::select(
            DB::raw('COUNT(*) as count'),
            DB::raw("DATE_FORMAT(created_at, '%b') as month"),
            DB::raw("MONTH(created_at) as month_num")
        )
            ->where('created_at', '>=', Carbon::now()->subMonths(12))
            ->groupBy('month', 'month_num')
            ->orderBy('month_num')
            ->get();

        $allMonths = [];
        for ($i = 0; $i < 12; $i++) {
            $month = Carbon::now()->subMonths(11 - $i)->format('M');
            $allMonths[$month] = 0;
        }

        foreach ($users as $item) {
            $allMonths[$item->month] = $item->count;
        }

        return [
            'labels' => array_keys($allMonths),
            'data' => array_values($allMonths)
        ];
    }
}
