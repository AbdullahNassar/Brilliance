<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
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

    public function home()
    {
        return view('welcome');
    }

    public function dashboard()
    {
        return view('admin.pages.home.home');
    }

    public function lang(Request $request,$locale) {        
        $request->session()->put('locale',$locale);
        return back();
    }
}
