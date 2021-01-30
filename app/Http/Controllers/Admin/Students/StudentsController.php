<?php

namespace App\Http\Controllers\Admin\Students;

use App\Http\Controllers\Admin\MainController;
use App\Http\Requests\Student\StoreStudentRequest;
use App\Http\Requests\Student\UpdateStudentRequest;
use App\Http\Requests\Student\StudentScheduleRequest;
use App\Http\Requests\Student\StudentProgressRequest;
use App\Http\Requests\Student\StoreStudentDocumentRequest;
use App\Helpers\StudentHelper;
use App\Helpers\EventModel;
use App\Student;
use App\StudentGrade;
use App\StudentRequiredDocument;
use App\StudentDocument;
use App\StudentSchedule;
use App\Corporate;
use App\StudentCorporate;
use App\Program;
use App\Doctor;
use App\Hall;
use App\HallSchedule;
use App\StudentCourse;
use App\StudentPayment;
use App\StudentProgress;
use App\StudentTransaction;
use App\ProgramIntake;
use App\ProgramCourse;
use App\Diplom;
use App\DiplomIntake;
use App\DiplomCourse;
use App\TrainingCourse;
use App\SalesLead;
use App\SalesActivity;
use App\User;
use App\Cash;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Auth;
use Calendar;
use Carbon;
use Printing;
use DB;
use Storage;
use Response;

class StudentsController extends MainController
{
    public $model = Student::class;

    public function insert(StoreStudentRequest $request){
        $student = StudentHelper::addStudent($request);
        if($student)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public function update(UpdateStudentRequest $request){
        $id = $request->id;
        $student = StudentHelper::editStudent($request,$id);
        if($student)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.update',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public function corporate(Request $request){
        $corporate = Corporate::create([
            'name' => $request['corp_name']
        ]);
        if($corporate)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
            'model' => class_basename(get_class(new Corporate))
        ])));
    }

    public function insertSchedule(StudentScheduleRequest $request){
        $student = Student::find($request['student_id']);
                $schedules = $request->schedules;
                if(!empty($schedules)){
                    foreach($schedules as $key=>$schedule){
                        $find = DB::table('student_schedule')->where('date', '=', $schedule['date'])->where('student_id','=',$request['student_id'])->get();
                        $hall = DB::table('hall_schedule')->where('hall_id',$request['hall_id'])->where('date',$schedule['date'])->where('time_from',$schedule['time_from'])->first();
                        $find2 = Hall::find($request['hall_id']);
                        if($hall != null && $find2->name != "Online"){
                            return $this->respondBadRequest(trans('messages.'.$this->messageKeyName().'.busy',[
                                'model' => class_basename(get_class(new Hall))
                            ]));	
                        }elseif($hall == null && $find2->name == "Online"){
                            if($find){
                                DB::table('student_schedule')->where('date', '=', $schedule['date'])->where('student_id','=',$request['student_id'])->delete();
                                $schedule = StudentSchedule::create([
                                    'type' => $schedule['type'],
                                    'date' => $schedule['date'],
                                    'time_from' => $schedule['time_from'],
                                    'hall_id' => $request['hall_id'],
                                    'time_to' => $schedule['time_to'],
                                    'student_id' => $student->id,
                                    'program_id' => $request['program_id'],
                                    'program_intake_id' => $request['program_intake_id'],
                                    'program_course_id' => $request['program_course_id'],
                                    'diplom_id' => $request['diplom_id'],
                                    'diplom_intake_id' => $request['diplom_intake_id'],
                                    'diplom_course_id' => $request['diplom_course_id'],
                                    'training_course_id' => $request['training_course_id'],
                                    'service' => $request['service'],
                                    'doctor_id' => $request['doctor_id'],
                                ]);

                                HallSchedule::create([
                                    'type' => $schedule['type'],
                                    'program_course_id' => $request['program_course_id'],
                                    'diplom_course_id' => $request['diplom_course_id'],
                                    'training_course_id' => $request['training_course_id'],
                                    'doctor_id' => $request['doctor_id'],
                                    'hall_id' => $request['hall_id'],
                                    'date' => $schedule['date'],
                                    'time_from' => $schedule['time_from'],
                                    'time_to' => $schedule['time_to'],
                                ]);
                            }else{
                                $schedule = StudentSchedule::create([
                                    'date' => $schedule['date'],
                                    'time_from' => $schedule['time_from'],
                                    'time_to' => $schedule['time_to'],
                                    'hall_id' => $request['hall_id'],
                                    'student_id' => $request['student_id'],
                                    'program_id' => $request['program_id'],
                                    'program_intake_id' => $request['program_intake_id'],
                                    'program_course_id' => $request['program_course_id'],
                                    'diplom_id' => $request['diplom_id'],
                                    'diplom_intake_id' => $request['diplom_intake_id'],
                                    'diplom_course_id' => $request['diplom_course_id'],
                                    'training_course_id' => $request['training_course_id'],
                                    'service' => $request['service'],
                                    'doctor_id' => $request['doctor_id'],
                                ]);

                                HallSchedule::create([
                                    'type' => $schedule['type'],
                                    'program_course_id' => $request['program_course_id'],
                                    'diplom_course_id' => $request['diplom_course_id'],
                                    'training_course_id' => $request['training_course_id'],
                                    'doctor_id' => $request['doctor_id'],
                                    'hall_id' => $request['hall_id'],
                                    'date' => $schedule['date'],
                                    'time_from' => $schedule['time_from'],
                                    'time_to' => $schedule['time_to'],
                                ]);
                            }
                        }
                    }
                }
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
            'model' => class_basename(get_class(new StudentSchedule))
        ])));
    }

    public function insertSchedules(StudentScheduleRequest $request){
        $schedules = $request->schedules;
        if(!empty($schedules)){
            foreach($schedules as $key=>$schedule){
                $hall = HallSchedule::where('hall_id',$request['hall_id'])->where('time_from',$schedule['time_from'])->where('hall_id',$schedule['date'])->first();
                $find = Hall::find($request['hall_id']);
                if($hall == null && $find->name == "Online"){
                        HallSchedule::create([
                            'type' => $schedule['type'],
                            'program_course_id' => $request['program_course_id'],
                            'diplom_course_id' => $request['diplom_course_id'],
                            'training_course_id' => $request['training_course_id'],
                            'doctor_id' => $request['doctor_id'],
                            'hall_id' => $request['hall_id'],
                            'date' => $schedule['date'],
                            'time_from' => $schedule['time_from'],
                            'time_to' => $schedule['time_to'],
                        ]);
                }elseif($hall != null && $find->name != "Online"){
                    return $this->respondBadRequest(trans('messages.'.$this->messageKeyName().'.busy',[
                        'model' => class_basename(get_class(new Hall))
                    ]));
                }
            }
        }
        $students = Student::all();
        foreach($students as $student){
            if($request['check'.$student->id] == 1 && $request['checked'.$student->id] == $student->id){
                $schedules = $request->schedules;
                if(!empty($schedules)){
                    foreach($schedules as $key=>$schedule){
                        $find = DB::table('student_schedule')->where('date', '=', $schedule['date'])->where('student_id','=',$request['student_id'])->get();
                            if($find){
                                DB::table('student_schedule')->where('date', '=', $schedule['date'])->where('student_id','=',$request['student_id'])->delete();
                                $schedule = StudentSchedule::create([
                                    'type' => $schedule['type'],
                                    'date' => $schedule['date'],
                                    'time_from' => $schedule['time_from'],
                                    'hall_id' => $request['hall_id'],
                                    'time_to' => $schedule['time_to'],
                                    'student_id' => $student->id,
                                    'program_id' => $request['program_id'],
                                    'program_intake_id' => $request['program_intake_id'],
                                    'program_course_id' => $request['program_course_id'],
                                    'diplom_id' => $request['diplom_id'],
                                    'diplom_intake_id' => $request['diplom_intake_id'],
                                    'diplom_course_id' => $request['diplom_course_id'],
                                    'training_course_id' => $request['training_course_id'],
                                    'service' => $request['service'],
                                    'doctor_id' => $request['doctor_id'],
                                ]);
                            }else{
                                $schedule = StudentSchedule::create([
                                    'date' => $schedule['date'],
                                    'time_from' => $schedule['time_from'],
                                    'time_to' => $schedule['time_to'],
                                    'hall_id' => $request['hall_id'],
                                    'student_id' => $request['student_id'],
                                    'program_id' => $request['program_id'],
                                    'program_intake_id' => $request['program_intake_id'],
                                    'program_course_id' => $request['program_course_id'],
                                    'diplom_id' => $request['diplom_id'],
                                    'diplom_intake_id' => $request['diplom_intake_id'],
                                    'diplom_course_id' => $request['diplom_course_id'],
                                    'training_course_id' => $request['training_course_id'],
                                    'service' => $request['service'],
                                    'doctor_id' => $request['doctor_id'],
                                ]);
                            }
                    }
                }
            }
        }
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
            'model' => class_basename(get_class(new StudentSchedule))
        ])));
    }

    public function insertProgress(StudentProgressRequest $request){
        $progress = StudentHelper::addStudentProgress($request);
        if($progress)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
            'model' => class_basename(get_class(new StudentProgress))
        ])));
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
        $program_intakes = ProgramIntake::where('program_id','=',$id)->where('active','=',1)->get();
        echo json_encode($program_intakes);
    }

    function program_course(Request $request){
        $id = $request->input('program_id');
        $program_courses = ProgramCourse::where('program_id','=',$id)->where('active','=',1)->get();
        echo json_encode($program_courses);
    }

    function diplom_intake(Request $request){
        $id = $request->input('diplom_id');
        $diplom_intakes = DiplomIntake::where('diplom_id','=',$id)->where('active','=',1)->get();
        echo json_encode($diplom_intakes);
    }

    function diplom_course(Request $request){
        $id = $request->input('diplom_id');
        $diplom_courses = DiplomCourse::where('diplom_id','=',$id)->where('active','=',1)->get();
        echo json_encode($diplom_courses);
    }

    public function upload(StoreStudentDocumentRequest $request){
        $old = StudentDocument::where('document_id',$request['document_id'])
                    ->where('student_id',$request['id'])->first();
        if($old)
        return json_encode($this->respondWithError(trans('messages.old')));

        $document = StudentHelper::addStudentDocument($request);
        if($document)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
            'model' => class_basename(get_class(new StudentDocument))
        ])));
    }

    public function index(){
        $students = Student::where('type','Student')->get();
        return view('admin.pages.students.index.index', compact('students'));
    }

    public function applicants(){
        $students = Student::where('type','Applicant')->get();
        return view('admin.pages.applicants.index.index', compact('students'));
    }

    public function grades(){
        $students = Student::where('training_course_id', null)->get();
        $doctors = Doctor::all();
        $program_courses = ProgramCourse::where('active',1)->get();
        $diplom_courses = DiplomCourse::where('active',1)->get();
        return view('admin.pages.students.index.grades', compact('students','doctors','program_courses','diplom_courses'));
    }

    public function profile($id){
        $count = 0;
        $student = Student::find($id);
        $student_documents = $student->studentDocuments;
        $documents = StudentRequiredDocument::all();
        foreach($student_documents as $d){
            $ids[$count] = $d->document_id;
            $count++;
        }
        $lead = SalesLead::where('id',$student->lead_id)->first();
        $activities = SalesActivity::where('sales_lead_id',$student->lead_id)->get();
        $studentCorporates = StudentCorporate::where('student_id',$id)->get();
        if($student)
        return view('admin.pages.students.profile.index', compact('student','studentCorporates','lead','activities','student_documents','documents'));
        else
        return redirect('/admin/students');
    }

    public function uploadIndex($id){
        $ids = array();
        $count = 0;
        $student = Student::find($id);
        $student_documents = $student->studentDocuments;
        $documents = StudentRequiredDocument::all();
        foreach($student_documents as $d){
            $ids[$count] = $d->document_id;
            $count++;
        }
        $student_required_documents = StudentRequiredDocument::all()->whereNotIn('id', $ids);
        if($student)
        return view('admin.pages.students.index.upload', compact('student','student_documents','student_required_documents','documents'));
        else
        return redirect('/admin/students');
    }

    public function scheduleIndex($id){
        $student = Student::find($id);
        $programs = Program::where('active',1)->get();
        $diploms = Diplom::where('active',1)->get();
        $courses = TrainingCourse::where('status',1)->get();
        $doctors = Doctor::all();
        $halls = Hall::all();
        if($student)
        return view('admin.pages.students.index.schedule', compact('student','programs','diploms','courses','doctors','halls'));
        else
        return redirect('/admin/students');
    }

    public function attendance(){
        $students = Student::all();
        $programs = Program::where('active',1)->get();
        $diploms = Diplom::where('active',1)->get();
        $courses = TrainingCourse::where('status',1)->get();
        $doctors = Doctor::all();
        $halls = Hall::all();
        if($students)
        return view('admin.pages.students.index.attendance', compact('students','programs','diploms','courses','doctors','halls'));
        else
        return redirect('/admin/students');
    }

    function studentsAttendance(Request $request){
        $doctor_id = $request->input('doctor_id');
        $diplom_course_id = $request->input('diplom_course_id');
        $program_course_id = $request->input('program_course_id');
        $training_course_id = $request->input('training_course_id');
        $consulting = $request->input('consulting');
        $date = $request->input('date');
        if($diplom_course_id != null){
            $students = DB::table('student_schedule')
                    ->join('students','student_schedule.student_id','students.id')
                    ->where('student_schedule.doctor_id',$doctor_id)
                    ->where('student_schedule.date',$date)
                    ->where('student_schedule.diplom_course_id',$diplom_course_id)
                    ->select('students.name as student_name','student_schedule.student_id as student_id','student_schedule.id as id','students.middle_name as student_middle_name','students.last_name as student_last_name','students.mobile1 as mobile','students.email1 as email')
                    ->get();

            echo json_encode($students);
        }
        if($program_course_id != null){
            $students = DB::table('student_schedule')
                    ->join('students','student_schedule.student_id','students.id')
                    ->where('student_schedule.doctor_id',$doctor_id)
                    ->where('student_schedule.date',$date)
                    ->where('student_schedule.program_course_id',$program_course_id)
                    ->select('students.name as student_name','student_schedule.student_id as student_id','student_schedule.id as id','students.middle_name as student_middle_name','students.last_name as student_last_name','students.mobile1 as mobile','students.email1 as email')
                    ->get();

            echo json_encode($students);
        }
        if($training_course_id != null){
            $students = DB::table('student_schedule')
                    ->join('students','student_schedule.student_id','students.id')
                    ->where('student_schedule.doctor_id',$doctor_id)
                    ->where('student_schedule.date',$date)
                    ->where('student_schedule.training_course_id',$training_course_id)
                    ->select('students.name as student_name','student_schedule.student_id as student_id','student_schedule.id as id','students.middle_name as student_middle_name','students.last_name as student_last_name','students.mobile1 as mobile','students.email1 as email')
                    ->get();
            echo json_encode($students);
        }
        
        if($consulting != null){
            $students = DB::table('student_schedule')
                    ->join('students','student_schedule.student_id','students.id')
                    ->where('student_schedule.doctor_id',$doctor_id)
                    ->where('student_schedule.date',$date)
                    ->where('service','consulting')
                    ->select('students.name as student_name','student_schedule.student_id as student_id','student_schedule.id as id','students.middle_name as student_middle_name','students.last_name as student_last_name','students.mobile1 as mobile','students.email1 as email')
                    ->get();
            echo json_encode($students);
        }
    }

    public function schedulesIndex(){
        $students = Student::all();
        $programs = Program::where('active',1)->get();
        $diploms = Diplom::where('active',1)->get();
        $courses = TrainingCourse::where('status',1)->get();
        $doctors = Doctor::all();
        $halls = Hall::all();
        return view('admin.pages.students.index.schedules', compact('students','programs','diploms','courses','doctors','halls'));
    }

    public function coursesIndex(){
        $students = Student::all();
        $programs = Program::where('active',1)->get();
        $diploms = Diplom::where('active',1)->get();
        $courses = TrainingCourse::where('status',1)->get();
        $doctors = Doctor::all();
        $halls = Hall::all();
        return view('admin.pages.students.index.courses', compact('students','programs','diploms','courses','doctors','halls'));
    }

    public function progress($id){
        $student = Student::find($id);
        $doctors = Doctor::all();
        $program_courses = ProgramCourse::where('active',1)->get();
        $diplom_courses = DiplomCourse::where('active',1)->get();
        if($student)
        return view('admin.pages.students.index.progress', compact('student','doctors','diplom_courses','program_courses'));
        else
        return redirect('/admin/students');
    }

    public function payment($id){
        $student = Student::find($id);
        if($student)
        return view('admin.pages.students.payment.index', compact('student'));
        else
        return redirect('/admin/students');
    }

    public function plan($id){
        $pay = StudentPayment::find($id);
        return view('admin.pages.students.payment.edit', compact('pay'));
    }

    public function editPlan(Request $request){
        $pay_id = $request->pay_id;
        $pay = StudentPayment::find($pay_id);
        StudentPayment::create([
            'date' => $request['date'],
            'egp_amount' => $request['egp_amount'],
            'usd_amount' => $request['usd_amount'],
            'euro_amount' => $request['euro_amount'],
            'name' => $pay['name'],
            'student_id' => $pay['student_id'],
        ]);
        StudentPayment::where('id',$pay_id)->delete();
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.update',[
            'model' => class_basename(get_class(new StudentPayment))
        ])));
    }

    public function pay($id){
        $student = Student::find($id);
        $now = Carbon::now()->format('j-m-Y');
        $payments = StudentPayment::where('student_id',$id)->get();
        $deleted = DB::table('student_payment')->where('student_id',$id)->where('deleted_at','!=',null)->get();
        if($student)
        return view('admin.pages.students.pay.pay', compact('student','payments','now','deleted'));
        else
        return redirect('/admin/students');
    }

    public function print($id){
        $student = Student::find($id);
        $now = Carbon::now()->format('j-m-Y');
        $payments = Cash::where('student_id',$id)->where('date',$now)->get();
        $total_egp = 0;
        $total_euro = 0;
        $total_usd = 0;
        foreach($payments as $payment){
            if($payment->currency == "egp"){
                $total_egp += $payment->amount;
            }
            if($payment->currency == "euro"){
                $total_euro += $payment->amount;
            }
            if($payment->currency == "usd"){
                $total_usd += $payment->amount;
            }
        }
        return view('admin.pages.print.invoice.index', compact('student','payments','now','total_egp','total_euro','total_usd'));
    }

    public function multipay(){
        $students = Student::all();
        $now = Carbon::now()->format('j-m-Y');
        return view('admin.pages.students.multipay.pay', compact('students','now'));
    }

    public function add(){
        $corporates = Corporate::all();
        $last = Corporate::where('deleted_at','=', null)->orWhere('deleted_at','!=', null)->orderBy('created_at', 'desc')->first();
        return view('admin.pages.students.add.index',compact('corporates','last'));
    }

    public function edit($id){
        $ids = array();
        $count = 0;
        $student = Student::find($id);
        $student_corporates = StudentCorporate::where('student_id',$id)->get();
        $corporates = Corporate::all();
        $student_documents = $student->studentDocuments;
        $programs = Program::where('active',1)->get();
        $diploms = Diplom::where('active',1)->get();
        $courses = TrainingCourse::where('status',1)->get();
        $program_intakes = ProgramIntake::where('active',1)->get();
        $program_courses = ProgramCourse::where('active',1)->get();
        $diplom_intakes = DiplomIntake::where('active',1)->get();
        $diplom_courses = DiplomCourse::where('active',1)->get();
        $documents = StudentRequiredDocument::all();
        foreach($student_documents as $d){
            $ids[$count] = $d->document_id;
            $count++;
        }
        $student_required_documents = StudentRequiredDocument::all()->whereNotIn('id', $ids);
        $last = Corporate::where('deleted_at','=', null)->orWhere('deleted_at','!=', null)->orderBy('created_at', 'desc')->first();

        if($student)
        return view('admin.pages.students.edit.index', compact('last','corporates','diplom_courses','diplom_intakes','program_courses','program_intakes','courses','diploms','programs','student','student_documents','student_required_documents','documents','student_corporates'));
        else
        return redirect('/admin/students');
    }

    public function schedule($id){
        $student = Student::find($id);
        if($student)
        return view('admin.pages.students.index.calendar', compact('student'));
        else
        return redirect('/admin/students');
    }

    public function destroy(Request $request){
        $id = $request->input('id');
        if (!$student = ($this->model)::find($id)) {
            return $this->respondBadRequest(trans('messages.'.$this->messageKeyName().'.notFound',['model' => class_basename(get_class(new $this->model))]));
        }
        Student::where('id',$id)->delete();
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.destroy',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }

    public function addGrades(Request $request){
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
                        'program_course_id' => $request['program_course_id'],
                        'grade' => $gradea,
                        'student_id' => $grade['student_id'],
                        'doctor_id' => $request['doctor_id'],
                    ]);
                    if($request['diplom_course_id'] != null)
                    StudentProgress::where('student_id',$grade['student_id'])->where('doctor_id',$request['doctor_id'])->where('diplom_course_id',$request['diplom_course_id'])->delete();
                    
                    if($request['program_course_id'] != null)
                    StudentProgress::where('student_id',$grade['student_id'])->where('doctor_id',$request['doctor_id'])->where('program_course_id',$request['program_course_id'])->delete();
                    if($gradea == "F"){
                        StudentProgress::create([
                            'date' => $now,
                            'status' => 'Failed',
                            'gpa' => $gpa,
                            'grade' => $gradea,
                            'total' => $total,
                            'diplom_course_id' => $request['diplom_course_id'],
                            'program_course_id' => $request['program_course_id'],
                            'student_id' => $grade['student_id'],
                            'doctor_id' => $request['doctor_id'],
                        ]);
                        if($request['diplom_course_id'] != null)
                        StudentCourse::where('diplom_course_id',$request['diplom_course_id'])->where('student_id' ,$grade['student_id'])->update([
                            'status' => 'Failed'
                        ]);

                        if($request['program_course_id'] != null)
                        StudentCourse::where('program_course_id',$request['program_course_id'])->where('student_id' ,$grade['student_id'])->update([
                            'status' => 'Failed'
                        ]);
                    }else{
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

                        if($request['diplom_course_id'] != null)
                        StudentCourse::where('diplom_course_id',$request['diplom_course_id'])->where('student_id' ,$grade['student_id'])->update([
                            'status' => 'Completed'
                        ]);

                        if($request['program_course_id'] != null)
                        StudentCourse::where('program_course_id',$request['program_course_id'])->where('student_id' ,$grade['student_id'])->update([
                            'status' => 'Completed'
                        ]);
                    }
                    
                }
            }
        }
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
            'model' => class_basename(get_class(new StudentGrade))
        ])));
    }

    public function addAttendance(Request $request){
        $students = StudentSchedule::all();
        foreach($students as $student){
            if($request['check'.$student->id] == 1 && $request['checked'.$student->id] == $student->id){
                $schedule = StudentSchedule::where('id',$request['checked'.$student->id])->update([
                    'attend' => 1,
                ]);
            }
        }
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.update',[
            'model' => class_basename(get_class(new StudentSchedule))
        ])));
    }

    public function addPayment(Request $request){
        $payments = $request->payments;
        foreach($payments as $payment){
            StudentPayment::create([
                'date' => $payment['date'],
                'name' => $payment['name'],
                'egp_amount' => $payment['egp_amount'],
                'usd_amount' => $payment['usd_amount'],
                'euro_amount' => $payment['euro_amount'],
                'student_id' => $request['student_id'],
            ]);
        }
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
            'model' => class_basename(get_class(new StudentPayment))
        ])));
    }

    public function addPay(Request $request){
        $cash = $request->cash;
        if(!empty($cash)){
            foreach($cash as $c){
                Cash::create([
                    'date' => $request['date'],
                    'currency' => $c['currency'],
                    'amount' => $c['amount'],
                    'description' => $c['description'],
                    'type' => $c['type'],
                    'student_id' => $request['student_id'],
                ]);
            }
        }
        
        $payments = $request->payments;
        if(!empty($payments))
        foreach($payments as $payment){
            if($payment['payment_id'] != null){
                $pay = StudentPayment::where('student_id',$request['student_id'])->where('id',$payment['payment_id'])->first();
                $egp_balance =  $pay->egp_amount - ($payment['egp_paid'] + $pay->egp_paid);
                $usd_balance =  $pay->usd_amount - ($payment['usd_paid'] + $pay->usd_paid);
                $euro_balance = $pay->euro_amount - ($payment['euro_paid'] + $pay->euro_paid);
                if($egp_balance == 0 && $usd_balance == 0 && $euro_balance == 0){
                    StudentPayment::where('student_id',$request['student_id'])->where('id',$payment['payment_id'])->update([
                        'egp_paid' => $payment['egp_paid'] + $pay->egp_paid,
                        'usd_paid' => $payment['usd_paid'] + $pay->usd_paid,
                        'euro_paid' => $payment['euro_paid'] + $pay->euro_paid,
                        'egp_balance' => $egp_balance,
                        'usd_balance' => $usd_balance,
                        'euro_balance' => $euro_balance,
                        'paid' => 1
                    ]);
                    StudentTransaction::create([
                        'date' => $request['date'],
                        'egp_amount' => $pay->egp_amount,
                        'usd_amount' => $pay->usd_amount,
                        'euro_amount' => $pay->euro_amount,
                        'egp_paid' => $payment['egp_paid'],
                        'usd_paid' => $payment['usd_paid'],
                        'euro_paid' => $payment['euro_paid'],
                        'egp_balance' => $egp_balance,
                        'usd_balance' => $usd_balance,
                        'euro_balance' => $euro_balance,
                        'student_payment_id' => $pay->id,
                        'student_id' => $pay->student_id,
                    ]);
                }else{
                    StudentPayment::where('student_id',$request['student_id'])->where('id',$payment['payment_id'])->update([
                        'egp_paid' => $payment['egp_paid'] + $pay->egp_paid,
                        'usd_paid' => $payment['usd_paid'] + $pay->usd_paid,
                        'euro_paid' => $payment['euro_paid'] + $pay->euro_paid,
                        'egp_balance' => $egp_balance,
                        'usd_balance' => $usd_balance,
                        'euro_balance' => $euro_balance,
                        'paid' => 0
                    ]);
                    StudentTransaction::create([
                        'date' => $request['date'],
                        'egp_amount' => $pay->egp_amount,
                        'usd_amount' => $pay->usd_amount,
                        'euro_amount' => $pay->euro_amount,
                        'egp_paid' => $payment['egp_paid'],
                        'usd_paid' => $payment['usd_paid'],
                        'euro_paid' => $payment['euro_paid'],
                        'egp_balance' => $egp_balance,
                        'usd_balance' => $usd_balance,
                        'euro_balance' => $euro_balance,
                        'student_payment_id' => $pay->id,
                        'student_id' => $pay->student_id,
                    ]);
                }
            }
        }
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
            'model' => class_basename(get_class(new StudentPayment))
        ])));
    }

    public function addmultipay(Request $request){
        $students = Student::all();
        foreach($students as $student){
            if($request['check'.$student->id] == 1 && $request['checked'.$student->id] == $student->id){
                $payments = $request->payments;
                if(!empty($payments)){
                    foreach($payments as $payment){
                        StudentPayment::create([
                            'date' => $payment['date'],
                            'name' => $payment['name'],
                            'egp_amount' => $payment['egp_amount'],
                            'usd_amount' => $payment['usd_amount'],
                            'euro_amount' => $payment['euro_amount'],
                            'student_id' => $student->id,
                        ]);
                    }
                }
            }
        }
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.store',[
            'model' => class_basename(get_class(new StudentPayment))
        ])));
    }

    public function convert($id){
        $student = Student::where('id',$id)->update([
            'type' => 'Student',
        ]);
        
        return redirect()->back();
    }

    public function paymentPrint($id){
        $student = Student::find($id);
        $now = Carbon::now()->format('j-m-Y');
        $payments = StudentPayment::where('student_id',$id)->get();
        $total_egp = 0;
        $total_euro = 0;
        $total_usd = 0;
        foreach($payments as $payment){
            if($payment->egp_amount != null){
                $total_egp += $payment->egp_amount;
            }
            if($payment->euro_amount != null){
                $total_euro += $payment->euro_amount;
            }
            if($payment->usd_amount != null){
                $total_usd += $payment->usd_amount;
            }
        }
        return view('admin.pages.print.payment.index', compact('student','now','payments','total_egp','total_euro','total_usd'));
    }
}