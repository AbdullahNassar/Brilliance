<?php

namespace App\Helpers;

use Carbon;
use App\Employee;
use App\User;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Request as RequestHelper;
use Intervention\Image\ImageManagerStatic as Image;
use DB;

class EmployeeHelper{
	
	public static function addEmployee($request)
	{
        $now = Carbon::now()->format('j-m-Y');
        $user = User::create([
            'name' => $request['name'],
            'role' => $request['role'],
            'email' => $request['email1'],
            'password' => Hash::make('password'),
        ]);
        
        $avatar = $request->file('image');
        $employee = Employee::create([
            'name' => $request['name'],
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
            'degree' => $request['degree'],
            'major' => $request['major'],
            'faculty' => $request['faculty'],
            'university' => $request['university'],
            'grade' => $request['grade'],
            'date' => $request['date'],
            'user_id' => $request['user_id'],
        ]);
        
        if($employee){
            $employee->assignRole($request->role);
            if($avatar != null) {
                $extension = $avatar->getClientOriginalExtension();
                $oldFileName = pathinfo($avatar->getClientOriginalName(), PATHINFO_FILENAME);
                $fileName = $request['name'] .'-'.$now.'-'. Str::random(5).'.'.$extension;
                Image::make($avatar->getRealPath())->resize(1000, 1000)->save( public_path('images/users/' . $fileName ));
                Employee::where('id',$employee->id)->update([
                    'image' => $fileName,
                ]);
                User::where('id',$user->id)->update([
                    'image' => $fileName,
                ]);
            }
            return ['data' => $employee];
        }       
    }
    
    public static function editEmployee($request,$id)
	{		
        $now = Carbon::now()->format('j-m-Y');
		if($employee = Employee::find($id)) {
		    $password = $employee->password;
            $avatar = $request->file('image');
            Employee::where('id',$id)->update([
                'name' => $request['name'],
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
                'degree' => $request['degree'],
                'major' => $request['major'],
                'faculty' => $request['faculty'],
                'university' => $request['university'],
                'grade' => $request['grade'],
                'date' => $request['date'],
                'user_id' => $request['user_id'],
            ]);
            if($employee){
                if($avatar != null) {
                    $extension = $avatar->getClientOriginalExtension();
                    $oldFileName = pathinfo($avatar->getClientOriginalName(), PATHINFO_FILENAME);
                    $fileName = $request['name'] .'-'.$request['middle_name'] .'-'.$request['last_name'] .'-'.$now.'-'. Str::random(5).'.'.$extension;
                    Image::make($avatar->getRealPath())->resize(1000, 1000)->save( public_path('images/users/' . $fileName ));
                    Employee::where('id',$employee->id)->update([
                        'image' => $fileName,
                    ]);
                    User::where('id',$employee->user_id)->update([
                        'image' => $fileName,
                    ]);
                }
                return ['data' => $employee];
            }       
		}
    }
}