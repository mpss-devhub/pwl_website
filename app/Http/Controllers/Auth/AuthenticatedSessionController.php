<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        if (! $request->authenticate()) {
            return back()->with('Error', 'User ID or Password is incorrect');
        }

        if (Auth::user()->status !== 'on') {
            Auth::logout();
            return redirect()->route('login')->with('Error', 'Your account is not active. Please contact support.');
        }

        $request->session()->regenerate();

        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('Success', 'Admin Login Successfully');
        } elseif (Auth::user()->role === 'merchant') {
            return redirect()->route('merchant.dashboard')->with('Success', 'Merchant Login Successfully');
        }

        return redirect()->intended('/')->with('Error', 'User ID or Password is incorrect');
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
       //dd($request->all());
        Auth::guard('web')->logout();
        Auth::guard('admin')->logout();
        Auth::guard('merchant')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('Success', 'Logout Successfully');
    }
}
