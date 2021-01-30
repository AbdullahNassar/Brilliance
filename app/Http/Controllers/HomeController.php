<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MarketingLead;
use App\SalesLead;
use Auth;
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
        $marketing_leads = MarketingLead::where('marketing_id',Auth::user()->id)->get();
        $sales_leads = SalesLead::where('sales_id',Auth::user()->id)->where('status','!=',5)->get();
        $manager_leads = SalesLead::where('manager_id',Auth::user()->id)->where('status','!=',5)->get();
        return view('admin.pages.home.home',compact('marketing_leads','sales_leads','manager_leads'));
    }

    public function lang(Request $request,$locale) {        
        $request->session()->put('locale',$locale);
        return back();
    }
}
