<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.customers.index');
    }

    /**
     * howToOrder
     *
     * @return void
     */
    public function howToOrder()
    {
        return view('pages.customers.how-to-order');
    }

    /**
     * about
     *
     * @return void
     */
    public function about()
    {
        return view('pages.customers.about-us');
    }

    /**
     * contact
     *
     * @return void
     */
    public function contact()
    {
        return view('pages.customers.contact-us');
    }
}
