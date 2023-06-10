<?php

namespace App\Http\Middleware;

use App\Models\LogRecord;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if (auth()->check() && (auth()->user()->suspend == 1))
        {
            Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login-view')->with('status', 'Your Account is Suspended.');
        }
        elseif(auth()->check() && (auth()->user()->active == 0)){

            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect()->route('admin.login-view')->with('status', 'Your Account is deactivated.');

        }

        return $next($request);
    }
}
