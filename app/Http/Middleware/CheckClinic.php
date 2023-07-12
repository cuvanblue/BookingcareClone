<?php

namespace App\Http\Middleware;

use App\Models\Clinic;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckClinic
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (Auth::user()->role >= 2) {
                $clinic = Clinic::find(Auth::user()->id);
                if ($clinic->status == 'working') {
                    return $next($request);
                }
            }
            return redirect()->route('error');
        }
        return redirect()->route('getlogin');
    }
}