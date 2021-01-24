<?php

namespace App\Helpers;

use Carbon;
use App\Student;
use App\User;
use App\Program;
use App\Diplom;
use App\Corporate;
use App\StudentCourse;
use App\StudentCorporate;
use App\StudentSchedule;
use App\StudentProgress;
use App\StudentDocument;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Request as RequestHelper;
use Intervention\Image\ImageManagerStatic as Image;
use DB;

class StudentHelper{
	
	public static function addStudent($request)
	{
        $now = Carbon::now()->format('j-m-Y');
        $user = User::create([
            'name' => $request['name'],
            'role' => 'student',
            'email' => $request['email1'],
            'password' => Hash::make('password'),
        ]);
        
        $role = $user->assignRole("student");
        $avatar = $request->file('image');
        $student = Student::create([
            'name' => $request['name'],
            'type' => $request['type'],
            'source' => $request['source'],
            'source_note' => $request['source_note'],
            'middle_name' => $request['middle_name'],
            'last_name' => $request['last_name'],
            'gender' => $request['gender'],
            'job' => $request['job'],
            'national_id' => $request['national_id'],
            'location' => $request['location'],
            'mobile1' => $request['mobile1'],
            'mobile2' => $request['mobile2'],
            'email1' => $request['email1'],
            'email2' => $request['email2'],
            'street' => $request['street'],
            'area' => $request['area'],
            'city' => $request['city'],
            'country' => $request['country'],
            'em_name' => $request['em_name'],
            'em_relation' => $request['em_relation'],
            'em_mobile' => $request['em_mobile'],
            'em_email' => $request['em_email'],
            'description' => $request['description'],
            'group_admission' => $request['group_admission'],
            'balance' => $request['balance'],
            'reference' => $request['reference'],
            'degree' => $request['degree'],
            'major' => $request['major'],
            'faculty' => $request['faculty'],
            'university' => $request['university'],
            'grade' => $request['grade'],
            'date' => $request['date'],
            'statement' => $request['statement'],
            'program_id' => $request['program_id'],
            'diplom_id' => $request['diplom_id'],
            'university_id' => $request['university_id'],
            'program_intake_id' => $request['program_intake_id'],
            'program_course_id' => $request['program_course_id'],
            'diplom_course_id' => $request['diplom_course_id'],
            'diplom_intake_id' => $request['diplom_intake_id'],
            'application_fees' => $request['application_fees'],
            'discount_rate' => $request['discount_rate'],
            'total_egp' => $request['total_egp'],
            'total_usd' => $request['total_usd'],
            'total_euro' => $request['total_euro'],
            'notes' => $request['notes'],
            'service' => $request['service'],
            'service_note' => $request['service_note'],
            'training_course_id' => $request['training_course_id'],
            'user_id' => $request['user_id'],
            'corporate_id' => $request['corporate_id'],
            'status' => 'Pending',
        ]);
        
        if($student){
            if($request['program_id'] != null){
                $program = Program::find($request['program_id']);
                foreach($program->courses as $course){
                    StudentCourse::create([
                        'program_course_id' => $course->id,
                        'student_id' => $student->id,
                        'status' => 'Pending',
                    ]);
                }
            }

            if($request['diplom_id'] != null){
                $diplom = Diplom::find($request['diplom_id']);
                foreach($diplom->courses as $course){
                    StudentCourse::create([
                        'diplom_course_id' => $course->id,
                        'student_id' => $student->id,
                        'status' => 'Pending',
                    ]);
                }
            }
            // if($request['program_id'] != null){
            //     $program = Program::find($request['program_id']);
            //     foreach($program->courses as $course){
            //         $progress = StudentProgress::create([
            //             'date' => $now,
            //             'gpa' => '',
            //             'grade' => '',
            //             'status' => 'Pending',
            //             'student_id' => $student->id,
            //             'doctor_id' => '',
            //             'notes' => '',
            //             'program_course_id' => $request['program_course_id'],
            //         ]);
            //     }
            // }
            // if($request['diplom_id'] != null){
            //     $diplom = Diplom::find($request['diplom_id']);
            //     foreach($diplom->courses as $course){
            //         $progress = StudentProgress::create([
            //             'date' => $now,
            //             'gpa' => '',
            //             'grade' => '',
            //             'status' => 'Pending',
            //             'student_id' => $student->id,
            //             'doctor_id' => '',
            //             'notes' => '',
            //             'diplom_course_id' => $request['diplom_course_id'],
            //         ]);
            //     }
            // }
            
            $corp_name = $request['corp_name'];
            $new_corporate = Corporate::where('name',$corp_name)->first();
            if($new_corporate == null){
                $corporate = Corporate::create([
                    'name' => $request['corp_name']
                ]);
            }
            $student->assignRole($request->role);
            if($avatar != null) {
                $extension = $avatar->getClientOriginalExtension();
                $oldFileName = pathinfo($avatar->getClientOriginalName(), PATHINFO_FILENAME);
                $fileName = $request['name'] .'-'.$now.'-'. Str::random(5).'.'.$extension;
                Image::make($avatar->getRealPath())->resize(1000, 1000)->save( public_path('images/users/' . $fileName ));
                Student::where('id',$student->id)->update([
                    'image' => $fileName,
                ]);
                User::where('id',$user->id)->update([
                    'image' => $fileName,
                ]);
            }
            $corporates = $request->corporates;
            if(!empty($corporates)){
                foreach($corporates as $key=>$corporate)
                {
                    StudentCorporate::create([
                        'student_id' => $student->id,
                        'corporate_id' => $corporate['corporate_id'],
                        'from' => $corporate['from'],
                        'to' => $corporate['to'],
                        'position' => $corporate['position'],
                    ]);
                }
            }
            return ['data' => $student];
        }       
    }

    public static function addStudentSchedule($request)
	{
        $student = Student::find($request['student_id']);
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
                        'time_to' => $schedule['time_to'],
                        'student_id' => $request['student_id'],
                        'hall_id' => $request['hall_id'],
                        'program_id' => $request['program_id'],
                        'program_intake_id' => $request['program_intake_id'],
                        'program_course_id' => $request['program_course_id'],
                        'diplom_id' => $request['diplom_id'],
                        'diplom_intake_id' => $request['diplom_intake_id'],
                        'diplom_course_id' => $request['diplom_course_id'],
                        'training_course_id' => $request['training_course_id'],
                        'notes' => $request['notes'],
                        'service' => $request['service'],
                        'doctor_id' => $request['doctor_id'],
                    ]);
                }else{
                    $schedule = StudentSchedule::create([
                        'date' => $schedule['date'],
                        'type' => $schedule['type'],
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
                        'notes' => $request['notes'],
                        'doctor_id' => $request['doctor_id'],
                    ]);
                }
            }
            return ['data' => $schedules];
        }
    }

    public static function addStudentSchedules($request)
	{
        $students = Student::all();
        foreach($students as $student){
            if($request['check'.$student->id] == 1 && $request['checked'.$student->id] == $student->id){
                $schedules = $request->schedules;
                if(!empty($schedules)){
                    foreach($schedules as $key=>$schedule){
                        $find = DB::table('student_schedule')->where('date', '=', $schedule['date'])->where('student_id','=',$request['student_id'])->get();
                        $hall = HallSchedule::where('hall_id',$request['hall_id'])->where('date',$schedule['date'])->where('time_from',$schedule['time_from'])->first();
                        if($find){
                            DB::table('student_schedule')->where('date', '=', $schedule['date'])->where('student_id','=',$request['student_id'])->delete();
                            $schedule = StudentSchedule::create([
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
                    return ['data' => $schedules];
                }
            }
        }
    }

    public static function addStudentDocument($request)
	{
        $student = Student::find($request['id']);
        $file = $request->file('statement');
        $path = public_path('images/students/documents/');
        $document = StudentDocument::create([
            'document_id' => $request['document_id'],
            'student_id' => $request['id'],
        ]);
        $now = Carbon::now()->format('j-m-Y');
        if($document){
            if($file != null) {
                $extension = $file->getClientOriginalExtension();
                if($extension != 'pdf'){
                    $oldFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $fileName = $student->name .'-'.$now.'-'. Str::random(5).'.'.$extension;
                    Image::make($file->getRealPath())->resize(3508, 2480)->save( public_path('images/students/documents/' . $fileName ));
                    StudentDocument::where('id',$document->id)->update([
                        'file' => $fileName,
                    ]);
                }else{
                    $fileName = Uploader::upload($file,$path);
                    StudentDocument::where('id',$document->id)->update([
                        'file' => $fileName,
                    ]);
                }
                
            }
            return ['data' => $document];
        }       
    }
    

    public static function editStudent($request,$id)
	{		
        $now = Carbon::now()->format('j-m-Y');
		if($student = Student::find($id)) {
		    $password = $student->password;
            $avatar = $request->file('image');
            Student::where('id',$id)->update([
                'name' => $request['name'],
                'type' => $request['type'],
                'source' => $request['source'],
                'source_note' => $request['source_note'],
                'middle_name' => $request['middle_name'],
                'last_name' => $request['last_name'],
                'gender' => $request['gender'],
                'job' => $request['job'],
                'national_id' => $request['national_id'],
                'location' => $request['location'],
                'mobile1' => $request['mobile1'],
                'mobile2' => $request['mobile2'],
                'email1' => $request['email1'],
                'email2' => $request['email2'],
                'street' => $request['street'],
                'area' => $request['area'],
                'city' => $request['city'],
                'country' => $request['country'],
                'em_name' => $request['em_name'],
                'em_relation' => $request['em_relation'],
                'em_mobile' => $request['em_mobile'],
                'em_email' => $request['em_email'],
                'description' => $request['description'],
                'group_admission' => $request['group_admission'],
                'balance' => $request['balance'],
                'reference' => $request['reference'],
                'degree' => $request['degree'],
                'major' => $request['major'],
                'faculty' => $request['faculty'],
                'university' => $request['university'],
                'grade' => $request['grade'],
                'date' => $request['date'],
                'statement' => $request['statement'],
                'program_id' => $request['program_id'],
                'diplom_id' => $request['diplom_id'],
                'program_course_id' => $request['program_course_id'],
                'diplom_course_id' => $request['diplom_course_id'],
                'university_id' => $request['university_id'],
                'program_intake_id' => $request['program_intake_id'],
                'diplom_intake_id' => $request['diplom_intake_id'],
                'application_fees' => $request['application_fees'],
                'discount_rate' => $request['discount_rate'],
                'total_egp' => $request['total_egp'],
                'total_usd' => $request['total_usd'],
                'total_euro' => $request['total_euro'],
                'notes' => $request['notes'],
                'service' => $request['service'],
                'service_note' => $request['service_note'],
                'training_course_id' => $request['training_course_id'],
                'user_id' => $request['user_id'],
                'corporate_id' => $request['corporate_id'],
            ]);
            if($student){
                StudentCourse::where('student_id',$id)->delete();
                if($request['program_id'] != null){
                    $program = Program::find($request['program_id']);
                    foreach($program->courses as $course){
                        StudentCourse::create([
                            'program_course_id' => $course->id,
                            'student_id' => $student->id,
                        ]);
                    }
                }
    
                if($request['diplom_id'] != null){
                    $diplom = Diplom::find($request['diplom_id']);
                    foreach($diplom->courses as $course){
                        StudentCourse::create([
                            'diplom_course_id' => $course->id,
                            'student_id' => $student->id,
                        ]);
                    }
                }
                $corp_name = $request['corp_name'];
                $new_corporate = Corporate::where('name',$corp_name)->first();
                if($new_corporate == null){
                    $corporate = Corporate::create([
                        'name' => $request['corp_name']
                    ]);
                }
                $corporates = $request->corporates;
                if(!empty($corporates)){
                    //StudentCorporate::where('student_id',$id)->delete();
                    foreach($corporates as $key=>$corporate)
                    {
                        StudentCorporate::create([
                            'student_id' => $id,
                            'corporate_id' => $corporate['corporate_id'],
                            'from' => $corporate['from'],
                            'to' => $corporate['to'],
                            'position' => $corporate['position'],
                        ]);
                    }
                }
                if($avatar != null) {
                    $extension = $avatar->getClientOriginalExtension();
                    $oldFileName = pathinfo($avatar->getClientOriginalName(), PATHINFO_FILENAME);
                    $fileName = $request['name'] .'-'.$request['middle_name'] .'-'.$request['last_name'] .'-'.$now.'-'. Str::random(5).'.'.$extension;
                    Image::make($avatar->getRealPath())->resize(1000, 1000)->save( public_path('images/users/' . $fileName ));
                    Student::where('id',$student->id)->update([
                        'image' => $fileName,
                    ]);
                    User::where('id',$student->user_id)->update([
                        'image' => $fileName,
                    ]);
                }
                return ['data' => $student];
            }       
		}
    }

    public static function addStudentProgress($request)
	{
        if($request['program_course_id'] != null)
        $progress = StudentCourse::where('student_id' , $request['student_id'])->where('program_course_id' , $request['program_course_id'])->update([
            'status' => $request['status'],
            'notes' => $request['notes'],
        ]);

        if($request['diplom_course_id'] != null)
        $progress = StudentCourse::where('student_id' , $request['student_id'])->where('diplom_course_id' , $request['diplom_course_id'])->update([
            'status' => $request['status'],
            'notes' => $request['notes'],
        ]);
        if($request['status'] == 'Excuse'){
            StudentSchedule::where('student_id',$request['student_id'])->delete();
        }
        return ['data' => $progress];
    }
}