<?php

namespace App\Helpers;

use App\Diplom;
use App\University;
use App\DiplomIntake;
use App\DiplomCourse;

class DiplomHelper{
	
	public static function addDiplom($request)
	{
        if($request['active'] == 1)
        $active = 1;
        else
        $active = 0;

        $diplom = Diplom::create([
            'name' => $request['name'],
            'university_id' => $request['university_id'],
            'active' => $active,
        ]); 
        if($diplom){
            return ['data' => $diplom];
        }         
    }

    public static function editDiplom($request,$id)
	{		
        if($request['active'] == 1)
        $active = 1;
        else
        $active = 0;

		if($diplom = Diplom::find($id)) {
            Diplom::where('id',$id)->update([
                'name' => $request['name'],
                'university_id' => $request['university_id'],
                'active' => $active,
            ]);
            return ['data' => $diplom];
		}
    }

    public static function addUniversity($request)
	{
        if($request['active'] == 1)
        $active = 1;
        else
        $active = 0;

        $university = University::create([
            'name' => $request['name'],
            'active' => $active,
        ]); 
        if($university){
            return ['data' => $university];
        }         
    }

    public static function editUniversity($request,$id)
	{	
        if($request['active'] == 1)
        $active = 1;
        else
        $active = 0;

		if($university = University::find($id)) {
            University::where('id',$id)->update([
                'name' => $request['name'],
                'active' => $active,
            ]);
            return ['data' => $university];
		}
    }

    public static function addDiplomIntake($request)
	{
        if($request['active'] == 1)
        $active = 1;
        else
        $active = 0;

        $intake = DiplomIntake::create([
            'name' => $request['name'],
            'status' => $request['status'],
            'diplom_id' => $request['diplom_id'],
            'start' => $request['start'],
            'active' => $active,
        ]); 
        if($intake){
            return ['data' => $intake];
        }         
    }

    public static function addDiplomCourse($request)
	{
        if($request['active'] == 1)
        $active = 1;
        else
        $active = 0;

        $course = DiplomCourse::create([
            'name' => $request['name'],
            'credits' => $request['credits'],
            'diplom_id' => $request['diplom_id'],
            'active' => $active,
        ]); 
        if($course){
            return ['data' => $course];
        }         
    }

    public static function editDiplomIntake($request,$id)
	{		
        if($request['active'] == 1)
        $active = 1;
        else
        $active = 0;

		if($intake = DiplomIntake::find($id)) {
            DiplomIntake::where('id',$id)->update([
                'name' => $request['name'],
                'status' => $request['status'],
                'diplom_id' => $request['diplom_id'],
                'start' => $request['start'],
                'active' => $active,
            ]);
            return ['data' => $intake];
		}
    }

    public static function editDiplomCourse($request,$id)
	{		
        if($request['active'] == 1)
        $active = 1;
        else
        $active = 0;

		if(DiplomCourse::find($id)) {
            $course = DiplomCourse::where('id',$id)->update([
                'name' => $request['name'],
                'credits' => $request['credits'],
                'diplom_id' => $request['diplom_id'],
                'active' => $active,
            ]);
            if($course){
                return ['data' => $course];
            } 
		}
    }
}