<?php

namespace App\Http\Controllers\Admin\Programs;

use App\Http\Controllers\Admin\MainController;
use App\Http\Requests\Program\StoreProgramIntakeRequest;
use App\Http\Requests\Program\UpdateProgramIntakeRequest;
use App\Http\Requests\Program\StoreProgramIntakeGradesRequest;
use App\Helpers\ProgramHelper;
use App\ProgramIntake;
use App\StudentGrade;
use App\ProgramCourse;
use App\Doctor;
use App\Program;
use App\Student;
use App\StudentProgress;
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

    public static function intake($id){
        $intake = ProgramIntake::find($id);
        $students = Student::where('program_intake_id',$id)->get();
        $grades = StudentGrade::all();
        $courses = ProgramCourse::where('active',1)->get();
        $doctors = Doctor::all();
        return view('admin.pages.intake.index', compact('doctors','intake','students','grades','courses'));
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
                        'diplom_course_id' => $request['diplom_course_id'],
                        'program_intake_id' => $grade['program_intake_id'],
                        'program_course_id' => $request['course_id'],
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