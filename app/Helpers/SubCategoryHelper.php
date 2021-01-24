<?php

namespace App\Helpers;

use App\SubCategory;
use App\Helpers\Request as RequestHelper;

class SubCategoryHelper{
	
	public static function addSubCategory($request)
	{
        $category = SubCategory::create(RequestHelper::mergeTransAttrs($request));
        if($category){
            return ['data' => $category];
        }       
	}

    public static function editSubCategory($request,$id)
	{		
		if($category = SubCategory::find($id)) {
            $category->update(RequestHelper::mergeTransAttrs($request));
            if($category){
                return ['data' => $category];
            }
		}
	}
}