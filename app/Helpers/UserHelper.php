<?php

namespace App\Helpers;

use Carbon;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Request as RequestHelper;
use Intervention\Image\ImageManagerStatic as Image;

class UserHelper{
	
	public static function addUser($request)
	{
        $now = Carbon::now()->format('j-m-Y');
        $avatar = $request->file('image');
        $user = User::create([
            'name' => $request['name'],
            'role' => $request['role'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        if($user){
            $user->assignRole($request->role);
            if($avatar != null) {
                $extension = $avatar->getClientOriginalExtension();
                $oldFileName = pathinfo($avatar->getClientOriginalName(), PATHINFO_FILENAME);
                $fileName = $request['name'] .'-'.$now.'-'. Str::random(5).'.'.$extension;
                Image::make($avatar->getRealPath())->resize(1000, 1000)->save( public_path('images/users/' . $fileName ) );
                User::where('id',$user->id)->update([
                    'image' => $fileName,
                ]);
            }
            return ['data' => $user];
        }       
    }
    

    public static function editUser($request,$id)
	{		
        $now = Carbon::now()->format('j-m-Y');
		if($user = User::find($id)) {
		    $password = $user->password;
            $avatar = $request->file('image');
            if($request->password == null)
            User::where('id',$id)->update([
                'name' => $request['name'],
                'role' => $request['role'],
                'email' => $request['email'],
                'password' => $password,
            ]);
            elseif($request->password != null)
            User::where('id',$id)->update([
                'name' => $request['name'],
                'role' => $request['role'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);
            if($user){
                $user->syncRoles([$request->role]);
                if($avatar != null) {
                    $extension = $avatar->getClientOriginalExtension();
                    $oldFileName = pathinfo($avatar->getClientOriginalName(), PATHINFO_FILENAME);
                    $fileName = $request['name'] .'-'.$now.'-'. Str::random(5).'.'.$extension;
                    Image::make($avatar->getRealPath())->resize(1000, 1000)->save( public_path('images/users/' . $fileName ) );
                    User::where('id',$user->id)->update([
                        'image' => $fileName,
                    ]);
                }
                return ['data' => $user];
            }       
		}
    }
}