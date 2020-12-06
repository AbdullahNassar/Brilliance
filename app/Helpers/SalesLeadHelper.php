<?php

namespace App\Helpers;

use Carbon;
use App\User;
use App\SalesLead;
use App\SalesActivity;
use App\Imports\SalesLeadsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Helpers\Request as RequestHelper;

class SalesLeadHelper{
	
	public static function addSalesLead($request)
	{
        $lead = SalesLead::create([
            'created_time' => $request['created_time'],
            'campaign_name' => $request['campaign_name'],
            'form_name' => $request['form_name'],
            'platform' => $request['platform'],
            'full_name' => $request['full_name'],
            'job_title' => $request['job_title'],
            'company_name' => $request['company_name'],
            'phone_number' => $request['phone_number'],
            'email' => $request['email'],
            'sales_id' => $request['sales_id'],
            'program_id' => $request['program_id'],
            'diplom_id' => $request['diplom_id'],
            'study' => $request['study'],
            'status' => 0
        ]);
        
        if($lead){
            return ['data' => $lead];
        }       
    }

    public static function addSalesLeadActivity($request)
	{
        $user = User::where('role','sales')->first();
        $id = $request['sales_lead_id'];
        $activity = SalesActivity::create([
            'type' => $request['type'],
            'status' => $request['status'],
            'next_call' => $request['next_call'],
            'notes' => $request['notes'],
            'sales_id' => $user->id,
            'sales_lead_id' => $request['sales_lead_id'],
        ]);
        if(!empty($request['program_id']) || !empty($request['diplom_id'])){
            if($lead = SalesLead::find($id)) {
                SalesLead::where('id',$id)->update([
                    'program_id' => $request['program_id'],
                    'diplom_id' => $request['diplom_id'],
                    'activity_status' => $request['status'],
                    'next_call' => $request['next_call'],
                ]);
                return ['data' => $lead];      
            }
        }
        if($activity){
            return ['data' => $lead];
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
    

    public static function editSalesLead($request,$id)
	{		
		if($lead = SalesLead::find($id)) {
            SalesLead::where('id',$id)->update([
                'created_time' => $request['created_time'],
                'campaign_name' => $request['campaign_name'],
                'form_name' => $request['form_name'],
                'platform' => $request['platform'],
                'full_name' => $request['full_name'],
                'job_title' => $request['job_title'],
                'company_name' => $request['company_name'],
                'phone_number' => $request['phone_number'],
                'email' => $request['email'],
                'sales_id' => $request['sales_id'],
                'program_id' => $request['program_id'],
                'diplom_id' => $request['diplom_id'],
                'study' => $request['study'],
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

        Excel::import(new SalesLeadsImport, $filepath);
        
        return ['data' => $file];
    }
}