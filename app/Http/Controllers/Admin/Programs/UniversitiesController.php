<?php

namespace App\Http\Controllers\Admin\Programs;

use App\Http\Controllers\Admin\MainController;
use App\Http\Requests\University\StoreUniversityRequest;
use App\Http\Requests\University\UpdateUniversityRequest;
use App\Helpers\ProgramHelper;
use App\University;
use App\Program;
use App\ProgramCourse;
use App\ProgramIntake;
use App\Diplom;
use App\DiplomCourse;
use App\DiplomIntake;
use Illuminate\Http\Request;

class UniversitiesController extends MainController
{
    public $model = University::class;

    public function insert(StoreUniversityRequest $request){
        $university = ProgramHelper::addUniversity($request);
        if($university)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public function update(UpdateUniversityRequest $request){
        $id = $request->id;
        $university = ProgramHelper::editUniversity($request,$id);
        if($university)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.update',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public static function index(){
        $universities = University::all();
        return view('admin.pages.universities.index.index', compact('universities'));
    }

    public static function add(){
        return view('admin.pages.universities.add.index');
    }

    public static function edit($id){
        $university = University::find($id);
        if($university)
        return view('admin.pages.universities.edit.index', compact('university'));
        else
        return redirect('/admin/universities');
    }

    public function destroy(Request $request){
        $id = $request->input('id');
        if (!$university = ($this->model)::find($id)) {
            return $this->respondBadRequest(trans('messages.'.$this->messageKeyName().'.notFound',['model' => class_basename(get_class(new $this->model))]));
        }
        University::where('id',$id)->delete();
        Program::where('university_id',$id)->delete();
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.destroy',[
                'model' => class_basename(get_class(new $this->model))
            ])));
    }

    public function unpublish($id){
        University::where('id',$id)->update([
            'active' => 0,
        ]);
        Program::where('university_id',$id)->update([
            'active' => 0,
        ]);

        $program = Program::where('university_id',$id)->first();
        ProgramCourse::where('program_id',$program->id)->update([
            'active' => 0,
        ]);
        ProgramIntake::where('program_id',$program->id)->update([
            'active' => 0,
        ]);

        Diplom::where('university_id',$id)->update([
            'active' => 0,
        ]);

        $diplom = Diplom::where('university_id',$id)->first();
        DiplomCourse::where('diplom_id',$diplom->id)->update([
            'active' => 0,
        ]);
        DiplomIntake::where('diplom_id',$diplom->id)->update([
            'active' => 0,
        ]);
        return redirect()->back();
    }

    public function publish($id){
        University::where('id',$id)->update([
            'active' => 1,
        ]);
        Program::where('university_id',$id)->update([
            'active' => 1,
        ]);

        $program = Program::where('university_id',$id)->first();
        ProgramCourse::where('program_id',$program->id)->update([
            'active' => 1,
        ]);
        ProgramIntake::where('program_id',$program->id)->update([
            'active' => 1,
        ]);

        Diplom::where('university_id',$id)->update([
            'active' => 1,
        ]);

        $diplom = Diplom::where('university_id',$id)->first();
        DiplomCourse::where('diplom_id',$diplom->id)->update([
            'active' => 1,
        ]);
        DiplomIntake::where('diplom_id',$diplom->id)->update([
            'active' => 1,
        ]);
        return redirect()->back();
    }
}