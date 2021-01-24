<?php

namespace App\Helpers;

use App\TrainingCategory;

class TrainingCategoryHelper{
	
	public static function addTrainingCategory($request)
	{
        if($request['status'] == 1)
        $status = 1;
        else
        $status = 0;

        $category = TrainingCategory::create([
            'name' => $request['name'],
            'status' => $status,
        ]); 
        if($category){
            return ['data' => $category];
        }         
    }

    public static function editTrainingCategory($request,$id)
	{		
        if($request['status'] == 1)
        $status = 1;
        else
        $status = 0;

		if($category = TrainingCategory::find($id)) {
            TrainingCategory::where('id',$id)->update([
                'name' => $request['name'],
                'status' => $status,
            ]);
            return ['data' => $category];
		}
    }
}