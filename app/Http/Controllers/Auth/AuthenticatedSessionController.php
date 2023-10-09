<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create()
    {
        return redirect()->route('welcome');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user_type_id = auth()->user()->user_type_id;

        switch ($user_type_id) {
            case 1:
                return redirect()->intended(RouteServiceProvider::SUPER_ADMIN);
                break;

            case 2:
                return redirect()->intended(RouteServiceProvider::ADMIN);
                break;

            case 3:
                return redirect()->intended(RouteServiceProvider::EDITOR);
                break;

            case 4:
                return redirect()->intended(RouteServiceProvider::GUARDIAN);
                break;

            case 5:
                return redirect()->intended(RouteServiceProvider::STUDENT);
                break;

            default:
                return redirect()->intended(RouteServiceProvider::DEFAULT);
                break;
        }

        // return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
