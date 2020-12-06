<?php

namespace App\Http\Controllers\Admin\Programs;

use App\Http\Controllers\Admin\MainController;
use App\Http\Requests\Program\StoreProgramCourseRequest;
use App\Http\Requests\Program\UpdateProgramCourseRequest;
use App\Helpers\ProgramHelper;
use App\Program;
use App\ProgramCourse;
use Illuminate\Http\Request;

class ProgramCoursesController extends MainController
{
    public $model = ProgramCourse::class;

    public function insert(StoreProgramCourseRequest $request){
        $program = ProgramHelper::addProgramCourse($request);
        if($program)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public function update(UpdateProgramCourseRequest $request){
        $id = $request->id;
        $program = ProgramHelper::editProgramCourse($request,$id);
        if($program)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.update',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public static function index(){
        $courses = ProgramCourse::all();
        return view('admin.pages.programs.courses.index.index', compact('courses'));
    }

    public static function add(){
        $programs = Program::where('active',1)->get();
        return view('admin.pages.programs.courses.add.index',compact('programs'));
    }

    public static function edit($id){
        $course = ProgramCourse::find($id);
        $programs = Program::where('active',1)->get();
        if($course)
        return view('admin.pages.programs.courses.edit.index', compact('course','programs'));
        else
        return redirect('/admin/programcourses');
    }

    public function destroy(Request $request){
        $id = $request->input('id');
        if (!$Program = ProgramCourse::find($id)) {
            return $this->respondBadRequest(trans('messages.'.$this->messageKeyName().'.notFound',['model' => class_basename(get_class(new $this->model))]));
        }
        ProgramCourse::where('id',$id)->delete();
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.destroy',[
                'model' => class_basename(get_class(new $this->model))
            ])));
    }

    public function unpublish($id){
        ProgramCourse::where('id',$id)->update([
            'active' => 0,
        ]);
        return redirect()->back();
    }

    public function publish($id){
        ProgramCourse::where('id',$id)->update([
            'active' => 1,
        ]);
        return redirect()->back();
    }
}