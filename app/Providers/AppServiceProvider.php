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

        View::composer('Merchant.*', function ($view) {
            if (Auth::check()) {
                $userId = Auth::user()->user_id;

                $count = Announcement::where(function ($query) use ($userId) {
                    $query->where('merchant_id', '"all"')
                        ->orWhereJsonContains('merchant_id', $userId);
                })
                    ->where('created_at', '>=', Carbon::now()->subDay())
                    ->count();
                $view->with('notificationCount', $count);
            }
        });
        View::composer('Admin.*', function ($view) {
            $user = Auth::user();
            $per = [];
            $access = [];
            if ($user && $user->permission) {
                $per = explode('-', $user->permission->permission ?? '');
                $allowed = $user->permission->allowed ?? '';
                $sections = explode(';', $allowed);
                foreach ($sections as $section) {
                    if (trim($section) == '') continue;

                    [$key, $value] = explode(':', $section);
                    $access[$key] = explode(',', $value);
                }
            }
            $view->with([
                'user' => $user,
                'per' => $per,
                'access' => $access,
            ]);
        });
    }
}
