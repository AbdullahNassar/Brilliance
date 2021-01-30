<?php

namespace App\Helpers;

use Carbon;
use App\MarketingLead;
use App\SalesLead;
use App\User;
use App\Imports\LeadsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Helpers\Request as RequestHelper;

class MarketingLeadHelper{
	
	public static function addMarketingLead($request)
	{
        $phone_number = MarketingLead::where('phone_number',$request[7])->first();
        $email = MarketingLead::where('email',$request[8])->first();
        if(!$phone_number && !$email && $request[0] != 'created_time' && $request[1] != 'campaign_name' && $request[2] != 'form_name' && $request[3] != 'platform' && $request[4] != 'full_name' && $request[5] != 'job_title' && $request[6] != 'company_name' && $request[7] != 'phone_number' && $request[8] != 'email'){
            $lead = MarketingLead::create([
                'created_time' => $request['created_time'],
                'campaign_name' => $request['campaign_name'],
                'form_name' => $request['form_name'],
                'platform' => $request['platform'],
                'full_name' => $request['full_name'],
                'job_title' => $request['job_title'],
                'company_name' => $request['company_name'],
                'phone_number' => $request['phone_number'],
                'email' => $request['email'],
                'marketing_id' => $request['marketing_id'],
                'status' => 1
            ]);
            $users = User::where('role','Sales Manager')->get();
            foreach($users as $user){
                SalesLead::create([
                    'created_time' => $request['created_time'],
                    'campaign_name' => $request['campaign_name'],
                    'form_name' => $request['form_name'],
                    'platform' => $request['platform'],
                    'full_name' => $request['full_name'],
                    'job_title' => $request['job_title'],
                    'company_name' => $request['company_name'],
                    'phone_number' => $request['phone_number'],
                    'email' => $request['email'],
                    'sales_id' => $user->id,
                    'program_id' => $request['program_id'],
                    'diplom_id' => $request['diplom_id'],
                    'status' => 0
                ]);
            }
            
            if($lead){
                return ['data' => $lead];
            }  
        }
    }

    public static function upload($request)
	{
        $file = $request->file('statement');
        $path = public_path('images/students/documents/');
        $document = StudentDocument::create([
            'document_id' => $request['document_id'],
            'student_id' => $request['id'],
        ]);
        $now = Carbon::now()->format('j-m-Y');
        if($document){
            if($file != null) {
                $extension = $file->getClientOriginalExtension();
                if($extension != 'pdf'){
                    $oldFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $fileName = $request['name'] .'-'.$now.'-'. Str::random(5).'.'.$extension;
                    Image::make($file->getRealPath())->resize(3508, 2480)->save( public_path('images/students/documents/' . $fileName ));
                    StudentDocument::where('id',$document->id)->update([
                        'file' => $fileName,
                    ]);
                }else{
                    $fileName = Uploader::upload($file,$path);
                    StudentDocument::where('id',$document->id)->update([
                        'file' => $fileName,
                    ]);
                }
                
            }
            return ['data' => $document];
        }       
    }
    

    public static function editMarketingLead($request,$id)
	{		
		if($lead = MarketingLead::find($id)) {
            MarketingLead::where('id',$id)->update([
                'created_time' => $request['created_time'],
                'campaign_name' => $request['campaign_name'],
                'form_name' => $request['form_name'],
                'platform' => $request['platform'],
                'full_name' => $request['full_name'],
                'job_title' => $request['job_title'],
                'company_name' => $request['company_name'],
                'phone_number' => $request['phone_number'],
                'email' => $request['email'],
                'marketing_id' => $request['marketing_id'],
                'status' => 0
            ]);
            return ['data' => $lead];      
		}
    }

    public static function insertData($request)
	{
        $file = $request->file('file');

        // File Details 
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $tempPath = $file->getRealPath();
        $fileSize = $file->getSize();
        $mimeType = $file->getMimeType();

        // Valid File Extensions
        $valid_extension = array("csv");

        // File upload location
        $location = 'uploads';

        // Upload file
        $file->move($location,$filename);

        // Import CSV to Database
        $filepath = public_path($location."/".$filename);

        Excel::import(new LeadsImport, $filepath);
        
        return ['data' => $file];
    }
}