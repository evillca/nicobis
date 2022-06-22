<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BuildingMenu $event)
    {
        $this->middleware('auth');        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}
