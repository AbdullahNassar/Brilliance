<?php

namespace App\Helpers;

use App\Program;
use App\University;
use App\ProgramIntake;
use App\ProgramCourse;

class ProgramHelper{
	
	public static function addProgram($request)
	{
        if($request['active'] == 1)
        $active = 1;
        else
        $active = 0;

        $program = Program::create([
            'name' => $request['name'],
            'university_id' => $request['university_id'],
            'active' => $active,
        ]); 
        if($program){
            return ['data' => $program];
        }         
    }

    public static function editProgram($request,$id)
	{		
        if($request['active'] == 1)
        $active = 1;
        else
        $active = 0;

		if($program = Program::find($id)) {
            Program::where('id',$id)->update([
                'name' => $request['name'],
                'university_id' => $request['university_id'],
                'active' => $active,
            ]);
            return ['data' => $program];
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

    public static function addProgramIntake($request)
	{
        if($request['active'] == 1)
        $active = 1;
        else
        $active = 0;

        $intake = ProgramIntake::create([
            'name' => $request['name'],
            'status' => $request['status'],
            'program_id' => $request['program_id'],
            'start' => $request['start'],
            'active' => $active,
        ]); 
        if($intake){
            return ['data' => $intake];
        }         
    }

    public static function addProgramCourse($request)
	{
        if($request['active'] == 1)
        $active = 1;
        else
        $active = 0;

        $course = ProgramCourse::create([
            'name' => $request['name'],
            'credits' => $request['credits'],
            'program_id' => $request['program_id'],
            'active' => $active,
        ]); 
        if($course){
            return ['data' => $course];
        }         
    }

    public static function editProgramIntake($request,$id)
	{		
        if($request['active'] == 1)
        $active = 1;
        else
        $active = 0;

		if($intake = ProgramIntake::find($id)) {
            ProgramIntake::where('id',$id)->update([
                'name' => $request['name'],
                'status' => $request['status'],
                'program_id' => $request['program_id'],
                'start' => $request['start'],
                'active' => $active,
            ]);
            return ['data' => $intake];
		}
    }

    public static function editProgramCourse($request,$id)
	{		
        if($request['active'] == 1)
        $active = 1;
        else
        $active = 0;

		if(ProgramCourse::find($id)) {
            $course = ProgramCourse::where('id',$id)->update([
                'name' => $request['name'],
                'credits' => $request['credits'],
                'program_id' => $request['program_id'],
                'active' => $active,
            ]);
            if($course){
                return ['data' => $course];
            } 
		}
    }
}