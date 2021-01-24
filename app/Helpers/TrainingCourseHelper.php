<?php

namespace App\Helpers;

use App\TrainingCourse;

class TrainingCourseHelper{
	
	public static function addTrainingCourse($request)
	{
        if($request['status'] == 1)
        $status = 1;
        else
        $status = 0;

        $course = TrainingCourse::create([
            'name' => $request['name'],
            'corporate_id' => $request['corporate_id'],
            'category_id' => $request['category_id'],
            'status' => $status,
        ]); 
        if($course){
            return ['data' => $course];
        }         
    }

    public static function editTrainingCourse($request,$id)
	{		
        if($request['status'] == 1)
        $status = 1;
        else
        $status = 0;

		if($course = TrainingCourse::find($id)) {
            TrainingCourse::where('id',$id)->update([
                'name' => $request['name'],
                'corporate_id' => $request['corporate_id'],
                'category_id' => $request['category_id'],
                'status' => $status,
            ]);
            return ['data' => $course];
		}
    }
}