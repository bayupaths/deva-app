<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.customers.index');
    }

    public function howToOrder()
    {
        return view('pages.customers.how-to-order');
    }

    public function about()
    {
        return view('pages.customers.about-us');
    }

    public function contact()
    {
        return view('pages.customers.contact-us');
    }
}
