<?php

namespace App\Http\Controllers\Admin\Programs;

use App\Http\Controllers\Admin\MainController;
use App\Http\Requests\Program\StoreProgramRequest;
use App\Http\Requests\Program\UpdateProgramRequest;
use App\Helpers\ProgramHelper;
use App\Program;
use App\University;
use App\ProgramCourse;
use App\ProgramIntake;
use Illuminate\Http\Request;

class ProgramsController extends MainController
{
    public $model = Program::class;

    public function insert(StoreProgramRequest $request){
        $Program = ProgramHelper::addProgram($request);
        if($Program)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public function update(UpdateProgramRequest $request){
        $id = $request->id;
        $Program = ProgramHelper::editProgram($request,$id);
        if($Program)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.update',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public static function index(){
        $programs = Program::all();
        return view('admin.pages.programs.index.index', compact('programs'));
    }

    public static function add(){
        $universities = University::where('active',1)->get();
        return view('admin.pages.programs.add.index', compact('universities'));
    }

    public static function edit($id){
        $program = Program::find($id);
        $universities = University::where('active',1)->get();
        if($program)
        return view('admin.pages.programs.edit.index', compact('program','universities'));
        else
        return redirect('/admin/programs');
    }

    public function destroy(Request $request){
        $id = $request->input('id');
        if (!$Program = ($this->model)::find($id)) {
            return $this->respondBadRequest(trans('messages.'.$this->messageKeyName().'.notFound',['model' => class_basename(get_class(new $this->model))]));
        }
        Program::where('id',$id)->delete();
        ProgramCourse::where('program_id',$id)->delete();
        ProgramIntake::where('program_id',$id)->delete();
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.destroy',[
                'model' => class_basename(get_class(new $this->model))
            ])));
    }
    
    public function unpublish($id){
        Program::where('id',$id)->update([
            'active' => 0,
        ]);
        ProgramCourse::where('program_id',$id)->update([
            'active' => 0,
        ]);
        ProgramIntake::where('program_id',$id)->update([
            'active' => 0,
        ]);
        return redirect()->back();
    }

    public function publish($id){
        Program::where('id',$id)->update([
            'active' => 1,
        ]);
        ProgramCourse::where('program_id',$id)->update([
            'active' => 1,
        ]);
        ProgramIntake::where('program_id',$id)->update([
            'active' => 1,
        ]);
        return redirect()->back();
    }


}