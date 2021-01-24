<?php

namespace App\Http\Controllers\Admin\Doctors;

use App\Http\Controllers\Admin\MainController;
use App\Http\Requests\Doctor\StoreDoctorRequest;
use App\Http\Requests\Doctor\UpdateDoctorRequest;
use App\Http\Requests\Doctor\DoctorScheduleRequest;
use App\Helpers\DoctorHelper;
use App\Doctor;
use App\DoctorSchedule;
use App\DoctorProgramCourse;
use App\DoctorDiplomCourse;
use App\DoctorTrainingCourse;
use App\Program;
use App\ProgramIntake;
use App\ProgramCourse;
use App\Diplom;
use App\Hall;
use App\DiplomIntake;
use App\DiplomCourse;
use App\TrainingCourse;
use Illuminate\Http\Request;
use DB;

class DoctorsController extends MainController
{
    public $model = Doctor::class;

    public function insert(StoreDoctorRequest $request){
        $doctor = DoctorHelper::addDoctor($request);
        if($doctor)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public function update(UpdateDoctorRequest $request){
        $id = $request->id;
        $doctor = DoctorHelper::editDoctor($request,$id);
        if($doctor)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.update',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public function insertSchedule(DoctorScheduleRequest $request){
        $schedule = DoctorHelper::addDoctorSchedule($request);
        if($schedule)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
            'model' => class_basename(get_class(new DoctorSchedule))
        ])));
    }

    public static function scheduleIndex($id){
        $doctor = Doctor::find($id);
        $halls = Hall::all();
        $programs = Program::where('active',1)->get();
        $diploms = Diplom::where('active',1)->get();
        $courses = TrainingCourse::where('status',1)->get();
        $program_intakes = ProgramIntake::where('active',1)->get();
        $program_courses = ProgramCourse::where('active',1)->get();
        $diplom_intakes = DiplomIntake::where('active',1)->get();
        $diplom_courses = DiplomCourse::where('active',1)->get();
        if($doctor)
        return view('admin.pages.doctors.index.schedule', compact('doctor','programs','program_courses','program_intakes','diploms','diplom_courses','diplom_intakes','courses','halls'));
        else
        return redirect('/admin/doctors');
    }

    public static function profile($id){
        $doctor = Doctor::find($id);
        if($doctor)
        return view('admin.pages.doctors.profile.index', compact('doctor'));
        else
        return redirect('/admin/doctors');
    }

    public static function index(){
        $doctors = Doctor::all();
        return view('admin.pages.doctors.index.index', compact('doctors'));
    }

    function programs(){
        $programs = DB::table('programs')
            ->join('universities','programs.university_id','universities.id')
            ->select('programs.name as program_name','programs.id as program_id','universities.name as university_name')
            ->where('programs.active', '=', 1)
            ->where('universities.active', '=', 1)
            ->get();
        echo json_encode($programs);
    }

    function diploms(){
        $diploms = DB::table('diploms')
            ->join('universities','diploms.university_id','universities.id')
            ->select('diploms.name as diplom_name','diploms.id as diplom_id','universities.name as university_name')
            ->where('diploms.active', '=', 1)
            ->where('universities.active', '=', 1)
            ->get();
        echo json_encode($diploms);
    }

    function courses(){
        $courses = TrainingCourse::where('status','=',1)->get();
        echo json_encode($courses);
    }

    function program_intake(Request $request){
        $id = $request->input('program_id');
        $program_intakes = ProgramIntake::where('active','=',1)->get();
        echo json_encode($program_intakes);
    }

    function program_course(Request $request){
        $id = $request->input('program_id');
        $program_courses = ProgramCourse::where('active','=',1)->get();
        echo json_encode($program_courses);
    }

    function diplom_intake(Request $request){
        $id = $request->input('diplom_id');
        $diplom_intakes = DiplomIntake::where('active','=',1)->get();
        echo json_encode($diplom_intakes);
    }

    function diplom_course(Request $request){
        $id = $request->input('diplom_id');
        $diplom_courses = DiplomCourse::where('active','=',1)->get();
        echo json_encode($diplom_courses);
    }

    public static function add(){
        $courses = TrainingCourse::where('status',1)->get();
        $program_courses = ProgramCourse::where('active',1)->get();
        $diplom_courses = DiplomCourse::where('active',1)->get();
        return view('admin.pages.doctors.add.index', compact('program_courses','diplom_courses','courses'));
    }

    public static function edit($id){
        $doctor = Doctor::find($id);
        $courses = TrainingCourse::where('status',1)->get();
        $selected_courses = DoctorTrainingCourse::where('doctor_id',$id)->get();
        $program_courses = ProgramCourse::where('active',1)->get();
        $selected_program_courses = DoctorProgramCourse::where('doctor_id',$id)->get();
        $diplom_courses = DiplomCourse::where('active',1)->get();
        $selected_diplom_courses = DoctorDiplomCourse::where('doctor_id',$id)->get();
        if($doctor)
        return view('admin.pages.doctors.edit.index', compact('doctor','program_courses','diplom_courses','courses'));
        else
        return redirect('/admin/doctors');
    }

    public function destroy(Request $request){
        $id = $request->input('id');
        if (!$doctor = ($this->model)::find($id)) {
            return $this->respondBadRequest(trans('messages.'.$this->messageKeyName().'.notFound',['model' => class_basename(get_class(new $this->model))]));
        }
        Doctor::where('id',$id)->delete();
        DoctorSchedule::where('doctor_id',$id)->delete();
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.destroy',[
                'model' => class_basename(get_class(new $this->model))
            ])));
    }
}