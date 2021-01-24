<?php

namespace App\Http\Controllers\Admin\Corporates;

use App\Http\Controllers\Admin\MainController;
use App\Http\Requests\Corporate\StoreCorporateRequest;
use App\Http\Requests\Corporate\StoreCorporateActivityRequest;
use App\Http\Requests\Corporate\UpdateCorporateRequest;
use App\Helpers\CorporateHelper;
use App\Corporate;
use App\Program;
use App\Diplom;
use App\User;
use App\CorporateActivity;
use App\TrainingCourse;
use Illuminate\Http\Request;

class CorporatesController extends MainController
{
    public $model = Corporate::class;

    public static function profile($id){
        $corporate = Corporate::find($id);
        $user = User::find($corporate->user_id);
        $activities = CorporateActivity::where('corporate_id',$id)->orderBy('created_at','DESC')->get();
        if($corporate)
        return view('admin.pages.corporates.profile.index', compact('corporate','activities','user'));
        else
        return redirect('/admin/corporates');
    }

    public function insert(StoreCorporateRequest $request){
        $corporate = CorporateHelper::addCorporate($request);
        if($corporate)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public function update(UpdateCorporateRequest $request){
        $id = $request->id;
        $corporate = CorporateHelper::editCorporate($request,$id);
        if($corporate)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.update',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public function addActivity(StoreCorporateActivityRequest $request){
        $id = $request->corporate_id;
        $corporate = CorporateHelper::addActivity($request,$id);
        if($corporate)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
            'model' => class_basename(get_class(new CorporateActivity))
        ])));
    }

    public static function index(){
        $corporates = Corporate::all();
        return view('admin.pages.corporates.index.index', compact('corporates'));
    }

    public static function add(){
        return view('admin.pages.corporates.add.index');
    }

    public static function edit($id){
        $corporate = Corporate::find($id);
        if($corporate)
        return view('admin.pages.corporates.edit.index', compact('corporate'));
        else
        return redirect('/admin/corporates');
    }

    public static function activity($id){
        $corporate = Corporate::find($id);
        $programs = Program::where('active',1)->get();
        $diploms = Diplom::where('active',1)->get();
        $courses = TrainingCourse::where('status',1)->get();
        if($corporate)
        return view('admin.pages.corporates.activity.index', compact('corporate','programs','diploms','courses'));
        else
        return redirect('/admin/corporates');
    }

    public function destroy(Request $request){
        $id = $request->input('id');
        if (!$corporate = ($this->model)::find($id)) {
            return $this->respondBadRequest(trans('messages.'.$this->messageKeyName().'.notFound',['model' => class_basename(get_class(new $this->model))]));
        }
        Corporate::where('id',$id)->delete();
        CorporateContact::where('corporate_id',$id)->delete();
        TrainingCourse::where('corporate_id',$id)->delete();
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.destroy',[
                'model' => class_basename(get_class(new $this->model))
            ])));
    }
}