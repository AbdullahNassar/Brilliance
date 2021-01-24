<?php

namespace App\Helpers;

use App\Category;
use App\Helpers\Request as RequestHelper;

class CategoryHelper{
	
	public static function addCategory($request)
	{
        $category = Category::create(RequestHelper::mergeTransAttrs($request));
        if($category){
            return ['data' => $category];
        }       
	}

    public static function editCategory($request,$id)
	{		
		if($category = Category::find($id)) {
            $category->update(RequestHelper::mergeTransAttrs($request));
            if($category){
                return ['data' => $category];
            }       
		}
	}
}