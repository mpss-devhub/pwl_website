<?php

namespace App\Providers;

use App\Models\announcement;
use Illuminate\Support\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useTailwind();

        View::composer('*', function ($view) {
            if (Auth::check()) {
                $userId = Auth::user()->user_id;
                $count = announcement::where('merchant_id', '"all"')
                    ->orWhereJsonContains('merchant_id', $userId)
                     ->where('created_at', '>=', Carbon::now()->subDay())
                    ->count();

                $view->with('notificationCount', $count);
            }
        });
    }
}
