<?php

namespace App\Http\Controllers\Admin\Diploms;

use App\Http\Controllers\Admin\MainController;
use App\Http\Requests\Diplom\StoreDiplomCourseRequest;
use App\Http\Requests\Diplom\UpdateDiplomCourseRequest;
use App\Helpers\DiplomHelper;
use App\Diplom;
use App\DiplomCourse;
use Illuminate\Http\Request;

class DiplomCoursesController extends MainController
{
    public $model = DiplomCourse::class;

    public function insert(StoreDiplomCourseRequest $request){
        $diplom = DiplomHelper::addDiplomCourse($request);
        if($diplom)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public function update(UpdateDiplomCourseRequest $request){
        $id = $request->id;
        $diplom = DiplomHelper::editDiplomCourse($request,$id);
        if($diplom)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.update',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public static function index(){
        $courses = DiplomCourse::all();
        return view('admin.pages.diploms.courses.index.index', compact('courses'));
    }

    public static function add(){
        $diploms = Diplom::where('active',1)->get();
        return view('admin.pages.diploms.courses.add.index',compact('diploms'));
    }

    public static function edit($id){
        $course = DiplomCourse::find($id);
        $diploms = Diplom::where('active',1)->get();
        if($course)
        return view('admin.pages.diploms.courses.edit.index', compact('course','diploms'));
        else
        return redirect('/admin/diplomcourses');
    }

    public function destroy(Request $request){
        $id = $request->input('id');
        if (!$Diplom = DiplomCourse::find($id)) {
            return $this->respondBadRequest(trans('messages.'.$this->messageKeyName().'.notFound',['model' => class_basename(get_class(new $this->model))]));
        }
        DiplomCourse::where('id',$id)->delete();
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.destroy',[
                'model' => class_basename(get_class(new $this->model))
            ])));
    }

    public function unpublish($id){
        DiplomCourse::where('id',$id)->update([
            'active' => 0,
        ]);
        return redirect()->back();
    }

    public function publish($id){
        DiplomCourse::where('id',$id)->update([
            'active' => 1,
        ]);
        return redirect()->back();
    }
}