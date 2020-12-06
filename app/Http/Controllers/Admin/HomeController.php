<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Speaker;
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

    public function dashboard()
    {
        return view('admin.pages.home.home');
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
