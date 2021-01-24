<?php

namespace App\Helpers;

use Carbon;
use App\User;
use App\Doctor;
use App\DoctorSchedule;
use App\DoctorProgramCourse;
use App\DoctorDiplomCourse;
use App\DoctorTrainingCourse;
use Illuminate\Support\Str;
use App\Helpers\Request as RequestHelper;
use App\Helpers\Uploader;
use Intervention\Image\ImageManagerStatic as Image;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Auth;

class DoctorHelper{
	
	public static function addDoctor($request)
	{
        $user = User::create([
            'name' => $request['name'],
            'role' => 'doctor',
            'email' => $request['email'],
            'password' => Hash::make('password'),
        ]);
        $role = $user->assignRole("doctor");
        $doctor = Doctor::create([
            'name' => $request['name'],
            'mobile' => $request['mobile'],
            'email' => $request['email'],
            'national_id' => $request['national_id'],
            'cv' => $request['cv'],
            'fees_per_day' => $request['fees_per_day'],
            'total_fees' => $request['total_fees'],
            'degree' => $request['degree'],
            'major' => $request['major'],
            'faculty' => $request['faculty'],
            'university' => $request['university'],
            'grade' => $request['grade'],
            'date' => $request['date'],
            'service' => $request['service'],
            'notes' => $request['notes'],
        ]);
        $program_courses = $request->program_courses;
        if($program_courses != null) {
            foreach($program_courses as $program_course){
                DoctorProgramCourse::create([
                    'doctor_id' => $doctor->id,
                    'program_course_id' => $program_course,
                ]);
            }
        }
        $diplom_courses = $request->diplom_courses;
        if($diplom_courses != null) {
            foreach($diplom_courses as $diplom_course){
                DoctorDiplomCourse::create([
                    'doctor_id' => $doctor->id,
                    'diplom_course_id' => $diplom_course,
                ]);
            }
        }
        $training_courses = $request->training_courses;
        if($training_courses != null) {
            foreach($training_courses as $training_course){
                DoctorTrainingCourse::create([
                    'doctor_id' => $doctor->id,
                    'training_course_id' => $training_course,
                ]);
            }
        }

        if($doctor){
            $now = Carbon::now()->format('j-m-Y');
            $avatar = $request->file('image');
            $file = $request->file('cv');
            $path = public_path('images/doctors/documents/');
            if($avatar != null) {
                $extension = $avatar->getClientOriginalExtension();
                $oldFileName = pathinfo($avatar->getClientOriginalName(), PATHINFO_FILENAME);
                $fileName = $request['name'] .'-'.$now.'-'. Str::random(5).'.'.$extension;
                Image::make($avatar->getRealPath())->resize(1000, 1000)->save( public_path('images/users/' . $fileName ) );
                
                Doctor::where('id',$doctor->id)->update([
                    'image' => $fileName,
                ]);
            }
            if($file != null){
                $cv = Uploader::upload($file,$path);
                Doctor::where('id',$doctor->id)->update([
                    'cv' => $cv,
                ]);
            }
            return ['data' => $doctor];
        }       
    }

    public static function editDoctor($request,$id)
	{		
		if($doctor = Doctor::find($id)) {
            Doctor::where('id',$id)->update([
                'name' => $request['name'],
                'mobile' => $request['mobile'],
                'email' => $request['email'],
                'national_id' => $request['national_id'],
                'fees_per_day' => $request['fees_per_day'],
                'total_fees' => $request['total_fees'],
                'degree' => $request['degree'],
                'major' => $request['major'],
                'faculty' => $request['faculty'],
                'university' => $request['university'],
                'grade' => $request['grade'],
                'date' => $request['date'],
                'service' => $request['service'],
                'notes' => $request['notes'],
            ]);
            DoctorProgramCourse::where('doctor_id',$id)->delete();
            $program_courses = $request->program_courses;
            if($program_courses != null) {
                foreach($program_courses as $program_course){
                    DoctorProgramCourse::create([
                        'doctor_id' => $doctor->id,
                        'program_course_id' => $program_course,
                    ]);
                }
            }
            DoctorDiplomCourse::where('doctor_id',$id)->delete();
            $diplom_courses = $request->diplom_courses;
            if($diplom_courses != null) {
                foreach($diplom_courses as $diplom_course){
                    DoctorDiplomCourse::create([
                        'doctor_id' => $doctor->id,
                        'diplom_course_id' => $diplom_course,
                    ]);
                }
            }
            DoctorTrainingCourse::where('doctor_id',$id)->delete();
            $training_courses = $request->training_courses;
            if($training_courses != null) {
                foreach($training_courses as $training_course){
                    DoctorTrainingCourse::create([
                        'doctor_id' => $doctor->id,
                        'training_course_id' => $training_course,
                    ]);
                }
            }
            if($doctor){
                $now = Carbon::now()->format('j-m-Y');
                $avatar = $request->file('image');
                $file = $request->file('cv');
                $path = public_path('images/doctors/documents/');
                if($avatar != null) {
                    $extension = $avatar->getClientOriginalExtension();
                    $oldFileName = pathinfo($avatar->getClientOriginalName(), PATHINFO_FILENAME);
                    $fileName = $request['name'] .'-'.$now.'-'. Str::random(5).'.'.$extension;
                    Image::make($avatar->getRealPath())->resize(1000, 1000)->save( public_path('images/users/' . $fileName ) );
                    Doctor::where('id',$doctor->id)->update([
                        'image' => $fileName,
                    ]);
                }
                if($file != null){
                    $cv = Uploader::upload($file,$path);
                    Doctor::where('id',$doctor->id)->update([
                        'cv' => $cv,
                    ]);
                }
                return ['data' => $doctor];
            } 
		}
    }

    public static function addDoctorSchedule($request)
	{
        $schedules = $request->schedules;
        if(!empty($schedules)){
            foreach($schedules as $key=>$schedule){
                $schedule = DoctorSchedule::create([
                    'date' => $schedule['date'],
                    'time_from' => $schedule['time_from'],
                    'time_to' => $schedule['time_to'],
                    'doctor_id' => $request['doctor_id'],
                    'program_id' => $request['program_id'],
                    'program_intake_id' => $request['program_intake_id'],
                    'program_course_id' => $request['program_course_id'],
                    'diplom_id' => $request['diplom_id'],
                    'diplom_intake_id' => $request['diplom_intake_id'],
                    'diplom_course_id' => $request['diplom_course_id'],
                    'training_course_id' => $request['training_course_id'],
                    'notes' => $request['notes'],
                    'service' => $request['service'],
                ]);
            }
        }
        return ['data' => $schedule];
    }
}