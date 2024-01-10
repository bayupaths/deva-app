<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminLoginController extends Controller
{
    /**
     * Function untuk menampilkan halaman login form
     *
     * @return void
     */
    public function index()
    {
        return view('pages.admin.auth.login');
    }

    /**
     * Memproses login
     *
     * @return void
     */
    public function process(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Kolom email harus diisi.',
            'email.email' => 'Kolom email harus valid.',
            'password.required' => 'Kolom password harus diisi.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin-login')->withErrors($validator)->withInput();
        }

        $kredensil = $request->only('email', 'password');

        if (auth()->guard('admin')->attempt($kredensil)) {
            return redirect()->route('dashboard-admin')->with('success', 'You are Logged in sucessfully.');
        } else {
            return redirect()->route('admin-login')->with('error', 'Whoops! invalid email and password.');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        auth()->guard('admin')->logout();
        return redirect()->route('admin-login')->with('success', 'You are Logged out sucessfully.');
    }
}
