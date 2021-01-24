<?php

namespace App\Helpers;

use App\OpportunityType;
use App\Helpers\Request as RequestHelper;

class OpportunityTypeHelper{
	
	public static function addOpportunityType($request)
	{
        $category = OpportunityType::create(RequestHelper::mergeTransAttrs($request));
        if($category){
            return ['data' => $category];
        }       
	}

    public static function editOpportunityType($request,$id)
	{		
		if($category = OpportunityType::find($id)) {
            $category->update(RequestHelper::mergeTransAttrs($request));
            if($category){
                return ['data' => $category];
            }       
		}
	}
}