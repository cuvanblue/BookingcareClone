<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LoginController extends Controller
{
    public function getLogin()
    {
        return view('UserViews.Login');
    }
    public function postLogin(LoginRequest $request)
    {
        if (
            Auth::attempt([
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ])
        ) {
            switch (Auth::user()->role) {
                case 1:
                    return redirect()->route('getdoctorhome');
                case 2:
                    return redirect()->route('getclinichome');
                case 3:
                    return redirect()->route('getadminhome');
            }
        }
        Session()->flash('error', 'Email hoặc Password không chính xác');
        return redirect()->back();
    }
    public function logOut(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}