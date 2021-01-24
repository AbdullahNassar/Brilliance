<?php

namespace App\Http\Controllers\Admin\Diploms;

use App\Http\Controllers\Admin\MainController;
use App\Http\Requests\Diplom\StoreDiplomIntakeRequest;
use App\Http\Requests\Diplom\UpdateDiplomIntakeRequest;
use App\Http\Requests\Diplom\StoreDiplomIntakeGradesRequest;
use App\Helpers\DiplomHelper;
use App\DiplomIntake;
use App\Student;
use App\Doctor;
use App\StudentGrade;
use App\StudentProgress;
use App\DiplomCourse;
use App\Diplom;
use Illuminate\Http\Request;
use Carbon;

class DiplomIntakesController extends MainController
{
    public $model = DiplomIntake::class;

    public function insert(StoreDiplomIntakeRequest $request){
        $diplom = DiplomHelper::addDiplomIntake($request);
        if($diplom)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public function update(UpdateDiplomIntakeRequest $request){
        $id = $request->id;
        $diplom = DiplomHelper::editDiplomIntake($request,$id);
        if($diplom)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.update',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public static function index(){
        $intakes = DiplomIntake::all();
        return view('admin.pages.diploms.intakes.index.index', compact('intakes'));
    }

    public static function add(){
        $diploms = Diplom::where('active',1)->get();
        $now = Carbon::now();
        return view('admin.pages.diploms.intakes.add.index',compact('diploms','now'));
    }

    public static function edit($id){
        $now = Carbon::now();
        $intake = DiplomIntake::find($id);
        $diploms = Diplom::where('active',1)->get();
        if($intake)
        return view('admin.pages.diploms.intakes.edit.index', compact('intake','diploms','now'));
        else
        return redirect('/admin/diplomintakes');
    }

    public static function intake($id){
        $intake = DiplomIntake::find($id);
        $students = Student::where('diplom_intake_id',$id)->get();
        $grades = StudentGrade::all();
        $doctors = Doctor::all();
        $courses = DiplomCourse::where('active',1)->get();
        return view('admin.pages.intake.index', compact('doctors','intake','students','grades','courses'));
    }

    public function destroy(Request $request){
        $id = $request->input('id');
        if (!$diplom = ($this->model)::find($id)) {
            return $this->respondBadRequest(trans('messages.'.$this->messageKeyName().'.notFound',['model' => class_basename(get_class(new $this->model))]));
        }
        DiplomIntake::where('id',$id)->delete();
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.destroy',[
                'model' => class_basename(get_class(new $this->model))
            ])));
    }

    public function unpublish($id){
        DiplomIntake::where('id',$id)->update([
            'active' => 0,
        ]);
        return redirect()->back();
    }

    public function publish($id){
        DiplomIntake::where('id',$id)->update([
            'active' => 1,
        ]);
        return redirect()->back();
    }

    public function addGrades(StoreProgramIntakeGradesRequest $request){
        $now = Carbon::now()->format('j-m-Y');
        $grades = $request->grades;
        if(!empty($grades)){
            foreach($grades as $key=>$grade){
                if($grade['attendance'] != null && $grade['assignment'] != null && $grade['final_exam'] != null){
                    $total = (integer)$grade['attendance'] + (integer)$grade['assignment'] + (integer)$grade['final_exam'];
                    $gpa = 0;
                    $gradea = "";
                    if($total < 60){
                        $gpa = 0;
                        $gradea = "F";
                    }elseif($total >= 61 && $total <= 70){
                        $gpa = 1;
                        $gradea = "D";
                    }elseif($total >= 71 && $total <= 80){
                        $gpa = 2;
                        $gradea = "C";
                    }elseif($total >= 81 && $total <= 90){
                        $gpa = 3;
                        $gradea = "B";
                    }elseif($total >= 91 && $total <= 100){
                        $gpa = 4;
                        $gradea = "A";
                    }
                    if($request['diplom_course_id'] != null)
                    StudentGrade::where('student_id',$grade['student_id'])->where('doctor_id',$request['doctor_id'])->where('diplom_course_id',$request['diplom_course_id'])->delete();
                    
                    if($request['program_course_id'] != null)
                    StudentGrade::where('student_id',$grade['student_id'])->where('doctor_id',$request['doctor_id'])->where('program_course_id',$request['program_course_id'])->delete();
                    $grade = StudentGrade::create([
                        'attendance' => $grade['attendance'],
                        'assignment' => $grade['assignment'],
                        'final_exam' => $grade['final_exam'],
                        'total' => $total,
                        'diplom_intake_id' => $grade['diplom_intake_id'],
                        'diplom_course_id' => $request['course_id'],
                        'grade' => $gradea,
                        'student_id' => $grade['student_id'],
                        'doctor_id' => $request['doctor_id'],
                    ]);
                    if($request['diplom_course_id'] != null)
                    StudentProgress::where('student_id',$grade['student_id'])->where('doctor_id',$request['doctor_id'])->where('diplom_course_id',$request['diplom_course_id'])->delete();
                    
                    if($request['program_course_id'] != null)
                    StudentProgress::where('student_id',$grade['student_id'])->where('doctor_id',$request['doctor_id'])->where('program_course_id',$request['program_course_id'])->delete();
                    StudentProgress::create([
                        'date' => $now,
                        'status' => 'Completed',
                        'gpa' => $gpa,
                        'grade' => $gradea,
                        'total' => $total,
                        'diplom_course_id' => $request['diplom_course_id'],
                        'program_course_id' => $request['program_course_id'],
                        'student_id' => $grade['student_id'],
                        'doctor_id' => $request['doctor_id'],
                    ]);
                }
            }
        }
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
            'model' => class_basename(get_class(new StudentGrade))
        ])));
    }
}