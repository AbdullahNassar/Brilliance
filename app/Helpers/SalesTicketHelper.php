<?php

namespace App\Helpers;

use Carbon;
use App\User;
use App\SalesTicket;
use App\Helpers\Request as RequestHelper;

class SalesTicketHelper{
	
	public static function addSalesTicket($request)
	{
        $ticket = SalesTicket::create([
            'source' => $request['source'],
            'study' => $request['study'],
            'full_name' => $request['full_name'],
            'job_title' => $request['job_title'],
            'company_name' => $request['company_name'],
            'phone_number' => $request['phone_number'],
            'email' => $request['email'],
            'sales_id' => $request['sales_id'],
            'program_id' => $request['program_id'],
            'diplom_id' => $request['diplom_id'],
            'status' => 0,
        ]);
        
        if($ticket){
            return ['data' => $ticket];
        }       
    }
    

    public static function editSalesTicket($request,$id)
	{		
		if($ticket = SalesTicket::find($id)) {
            SalesTicket::where('id',$id)->update([
                'source' => $request['source'],
                'study' => $request['study'],
                'full_name' => $request['full_name'],
                'job_title' => $request['job_title'],
                'company_name' => $request['company_name'],
                'phone_number' => $request['phone_number'],
                'email' => $request['email'],
                'sales_id' => $request['sales_id'],
                'program_id' => $request['program_id'],
                'diplom_id' => $request['diplom_id'],
                'status' => $request['status'],
            ]);
            return ['data' => $ticket];      
		}
    }
}