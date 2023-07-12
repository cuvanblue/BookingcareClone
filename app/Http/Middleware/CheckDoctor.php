<?php

namespace App\Http\Middleware;

use App\Models\Doctor;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckDoctor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (Auth::user()->role >= 1) {
                $doctor = Doctor::find(Auth::user()->id);
                if ($doctor->status == 'working') {
                    return $next($request);
                }
            }
            return redirect()->route('error');
        }
        return redirect()->route('getlogin');
    }
}