<?php

namespace App\Http\Controllers\Admin\TrainingCourses;

use App\Http\Controllers\Admin\MainController;
use App\Http\Requests\TrainingCourse\StoreTrainingCourseRequest;
use App\Http\Requests\TrainingCourse\UpdateTrainingCourseRequest;
use App\Helpers\TrainingCourseHelper;
use App\Corporate;
use App\TrainingCategory;
use App\TrainingCourse;
use Illuminate\Http\Request;

class TrainingCoursesController extends MainController
{
    public $model = TrainingCourse::class;

    public function insert(StoreTrainingCourseRequest $request){
        $course = TrainingCourseHelper::addTrainingCourse($request);
        if($course)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public function update(UpdateTrainingCourseRequest $request){
        $id = $request->id;
        $course = TrainingCourseHelper::editTrainingCourse($request,$id);
        if($course)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.update',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public static function index(){
        $courses = TrainingCourse::all();
        return view('admin.pages.training.courses.index.index', compact('courses'));
    }

    public static function add(){
        $corporates = Corporate::all();
        $categories = TrainingCategory::where('status',1)->get();
        return view('admin.pages.training.courses.add.index',compact('corporates','categories'));
    }

    public static function edit($id){
        $course = TrainingCourse::find($id);
        $corporates = Corporate::all();
        $categories = TrainingCategory::where('status',1)->get();
        if($course)
        return view('admin.pages.training.courses.edit.index', compact('course','corporates','categories'));
        else
        return redirect('/admin/trainingcourses');
    }

    public function destroy(Request $request){
        $id = $request->input('id');
        if (!$course = TrainingCourse::find($id)) {
            return $this->respondBadRequest(trans('messages.'.$this->messageKeyName().'.notFound',['model' => class_basename(get_class(new $this->model))]));
        }
        TrainingCourse::where('id',$id)->delete();
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.destroy',[
                'model' => class_basename(get_class(new $this->model))
            ])));
    }

    public function unpublish($id){
        TrainingCourse::where('id',$id)->update([
            'status' => 0,
        ]);
        return redirect()->back();
    }

    public function publish($id){
        TrainingCourse::where('id',$id)->update([
            'status' => 1,
        ]);
        return redirect()->back();
    }
}