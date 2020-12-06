<?php

namespace App\Helpers;

use Carbon;
use App\Student;
use App\StudentDocument;
use Illuminate\Support\Str;
use App\Helpers\Request as RequestHelper;
use Intervention\Image\ImageManagerStatic as Image;

class StudentHelper{
	
	public static function addStudent($request)
	{
        $user = User::create([
            'name' => $request['name'],
            'role' => 'student',
            'email' => $request['email1'],
            'password' => Hash::make('password'),
        ]);
        $user->assignRole('student');
        $avatar = $request->file('image');
        $student = Student::create([
            'name' => $request['name'],
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
            'diplom_intake_id' => $request['diplom_intake_id'],
            'user_id' => $user->id,
        ]);
        
        if($student){
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
            return ['data' => $student];
        }       
    }

    public static function addStudentDocument($request)
	{
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
                    $fileName = $request['name'] .'-'.$now.'-'. Str::random(5).'.'.$extension;
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
                'middle_name' => $request['middle_name'],
                'last_name' => $request['last_name'],
                'gender' => $request['gender'],
                'job' => $request['job'],
                'national_id' => $request['national_id'],
                'location' => $request['locations'],
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
                'diplom_intake_id' => $request['diplom_intake_id'],
            ]);
            if($student){
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
}