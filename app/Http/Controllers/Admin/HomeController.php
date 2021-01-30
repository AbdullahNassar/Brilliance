<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\MarketingLead;
use App\SalesLead;
use Auth;

class HomeController extends Controller
{
    public $model = Speaker::class;
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

    public function profile($id)
    {
        $user = User::find($id);
        return view('admin.pages.profile.index', compact('user'));
    }

    public function dashboard()
    {
        //app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
        $marketing_leads = MarketingLead::where('marketing_id',Auth::user()->id)->get();
        $sales_leads = SalesLead::where('sales_id',Auth::user()->id)->where('status','!=',5)->get();
        $manager_leads = SalesLead::where('manager_id',Auth::user()->id)->where('status','!=',5)->get();
        return view('admin.pages.home.home',compact('marketing_leads','sales_leads','manager_leads'));
    }

    public function speaks()
    {
        $speaks = Speaker::all();
        return view('admin.pages.speaks.index.index', compact('speaks'));
    }

    public function destroy(Request $request){
        $id = $request->input('id');
        if (!$speak = Speaker::find($id)) {
            return $this->respondBadRequest(trans('messages.'.$this->messageKeyName().'.notFound',['model' => class_basename(get_class(new $this->model))]));
        }
        Speaker::where('id',$id)->delete();
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.destroy',[
                'model' => class_basename(get_class(new $this->model))
            ])));
    }

    public function markAsRead()
    {
        Auth::guard('admins')->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
}
