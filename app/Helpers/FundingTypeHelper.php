<?php

namespace App\Helpers;

use App\FundingType;
use App\Helpers\Request as RequestHelper;

class FundingTypeHelper{
	
	public static function addFundingType($request)
	{
        $category = FundingType::create(RequestHelper::mergeTransAttrs($request));
        if($category){
            return ['data' => $category];
        }       
	}

    public static function editFundingType($request,$id)
	{		
		if($category = FundingType::find($id)) {
            $category->update(RequestHelper::mergeTransAttrs($request));
            if($category){
                return ['data' => $category];
            }       
		}
	}
}