<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->guard('admin')->attempt(['email' => $request->input('email'),  'password' => $request->input('password')])) {
            return redirect()->route('dashboard-admin')->with('success', 'You are Logged in sucessfully.');
        } else {
            return back()->with('error', 'Whoops! invalid email and password.');
        }
    }

    public function logout(Request $request)
    {
       $request->session()->flush();
       auth()->guard('admin')->logout();
       return redirect()->route('admin-login');
    }
}
