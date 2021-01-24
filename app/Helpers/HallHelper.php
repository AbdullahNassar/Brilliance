<?php

namespace App\Helpers;

use App\Hall;

class HallHelper{
	
	public static function addHall($request)
	{
        if($request['active'] == 1)
        $active = 1;
        else
        $active = 0;

        $hall = Hall::create([
            'name' => $request['name'],
            'active' => $active,
        ]); 
        if($hall){
            return ['data' => $hall];
        }         
    }

    public static function editHall($request,$id)
	{		
        if($request['active'] == 1)
        $active = 1;
        else
        $active = 0;

		if($hall = Hall::find($id)) {
            Hall::where('id',$id)->update([
                'name' => $request['name'],
                'active' => $active,
            ]);
            return ['data' => $hall];
		}
    }
}