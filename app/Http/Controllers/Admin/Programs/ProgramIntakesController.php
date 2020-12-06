<?php

namespace App\Http\Controllers\Admin\Programs;

use App\Http\Controllers\Admin\MainController;
use App\Http\Requests\Program\StoreProgramIntakeRequest;
use App\Http\Requests\Program\UpdateProgramIntakeRequest;
use App\Helpers\ProgramHelper;
use App\ProgramIntake;
use App\Program;
use Illuminate\Http\Request;
use Carbon;

class ProgramIntakesController extends MainController
{
    public $model = ProgramIntake::class;

    public function insert(StoreProgramIntakeRequest $request){
        $program = ProgramHelper::addProgramIntake($request);
        if($program)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public function update(UpdateProgramIntakeRequest $request){
        $id = $request->id;
        $program = ProgramHelper::editProgramIntake($request,$id);
        if($program)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.update',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public static function index(){
        $intakes = ProgramIntake::all();
        return view('admin.pages.programs.intakes.index.index', compact('intakes'));
    }

    public static function add(){
        $programs = Program::where('active',1)->get();
        $now = Carbon::now();
        return view('admin.pages.programs.intakes.add.index',compact('programs','now'));
    }

    public static function edit($id){
        $now = Carbon::now();
        $intake = ProgramIntake::find($id);
        $programs = Program::where('active',1)->get();
        if($intake)
        return view('admin.pages.programs.intakes.edit.index', compact('intake','programs','now'));
        else
        return redirect('/admin/programintakes');
    }

    public function destroy(Request $request){
        $id = $request->input('id');
        if (!$program = ($this->model)::find($id)) {
            return $this->respondBadRequest(trans('messages.'.$this->messageKeyName().'.notFound',['model' => class_basename(get_class(new $this->model))]));
        }
        ProgramIntake::where('id',$id)->delete();
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.destroy',[
                'model' => class_basename(get_class(new $this->model))
            ])));
    }

    public function unpublish($id){
        ProgramIntake::where('id',$id)->update([
            'active' => 0,
        ]);
        return redirect()->back();
    }

    public function publish($id){
        ProgramIntake::where('id',$id)->update([
            'active' => 1,
        ]);
        return redirect()->back();
    }
}