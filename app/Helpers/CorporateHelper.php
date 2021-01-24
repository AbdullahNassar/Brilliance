<?php

namespace App\Helpers;

use Carbon;
use App\User;
use App\Corporate;
use App\CorporateContact;
use App\CorporateActivity;
use Illuminate\Support\Str;
use App\Imports\CorporatesImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Helpers\Request as RequestHelper;
use App\Helpers\Uploader;
use Intervention\Image\ImageManagerStatic as Image;
use Auth;

class CorporateHelper{
	
	public static function addCorporate($request)
	{
        $corporate = Corporate::create([
            'source' => $request['source'],
            'source_note' => $request['source_note'],
            'name' => $request['name'],
            'industry' => $request['industry'],
            'street' => $request['street'],
            'area' => $request['area'],
            'city' => $request['city'],
            'landmark' => $request['landmark'],
            'country' => $request['country'],
            'website' => $request['website'],
            'email' => $request['email'],
            'mobile' => $request['mobile'],
            'fax' => $request['fax'],
            'user_id' => Auth::user()->id,
        ]);
        
        $contacts = $request->contacts;
        if(!empty($contacts)){
            foreach($contacts as $key=>$contact)
            {
                if($contact['default'] == 1)
                $default = 1;
                else
                $default = 0;
                CorporateContact::create([
                    'corporate_id' => $corporate->id,
                    'name' => $contact['name'],
                    'email' => $contact['email'],
                    'mobile' => $contact['mobile'],
                    'position' => $contact['position'],
                    'default' => $default,
                ]);
            }
        }
        
        if($corporate){
            $now = Carbon::now()->format('j-m-Y');
            $avatar = $request->file('logo');
            if($avatar != null) {
                $extension = $avatar->getClientOriginalExtension();
                $oldFileName = pathinfo($avatar->getClientOriginalName(), PATHINFO_FILENAME);
                $fileName = $request['name'] .'-'.$now.'-'. Str::random(5).'.'.$extension;
                Image::make($avatar->getRealPath())->resize(1000, 1000)->save( public_path('images/corporates/' . $fileName ) );
                Corporate::where('id',$corporate->id)->update([
                    'logo' => $fileName,
                ]);
            }
            return ['data' => $corporate];
        }       
    }

    public static function editCorporate($request,$id)
	{		
		if($corporate = Corporate::find($id)) {
            Corporate::where('id',$id)->update([
                'source' => $request['source'],
                'source_note' => $request['source_note'],
                'name' => $request['name'],
                'industry' => $request['industry'],
                'street' => $request['street'],
                'area' => $request['area'],
                'city' => $request['city'],
                'landmark' => $request['landmark'],
                'country' => $request['country'],
                'website' => $request['website'],
                'email' => $request['email'],
                'mobile' => $request['mobile'],
                'fax' => $request['fax'],
                'user_id' => Auth::user()->id,
            ]);

            CorporateContact::where('corporate_id',$id)->delete();
            $contacts = $request->contacts;
            if(!empty($contacts)){
                foreach($contacts as $key=>$contact)
                {
                    CorporateContact::create([
                        'corporate_id' => $id,
                        'name' => $contact['name'],
                        'email' => $contact['email'],
                        'mobile' => $contact['mobile'],
                        'position' => $contact['position'],
                        'default' => $contact['default'],
                    ]);
                }
            }

            if($corporate){
                $now = Carbon::now()->format('j-m-Y');
                $avatar = $request->file('logo');
                if($avatar != null) {
                    $extension = $avatar->getClientOriginalExtension();
                    $oldFileName = pathinfo($avatar->getClientOriginalName(), PATHINFO_FILENAME);
                    $fileName = $request['name'] .'-'.$now.'-'. Str::random(5).'.'.$extension;
                    Image::make($avatar->getRealPath())->resize(1000, 1000)->save( public_path('images/corporates/' . $fileName ) );
                    Corporate::where('id',$corporate->id)->update([
                        'logo' => $fileName,
                    ]);
                }
                return ['data' => $corporate];
            } 
		}
    }

    public static function addActivity($request,$id)
	{
        $now = Carbon::now()->format('j-m-Y');
        $activity = CorporateActivity::create([
            'service' => $request['service'],
            'status' => $request['status'],
            'user_id' => Auth::user()->id,
            'program_id' => $request['program_id'],
            'diplom_id' => $request['diplom_id'],
            'corporate_id' => $id,
            'training_course_id' => $request['training_course_id'],
            'notes' => $request['notes'],
        ]);

        if(!empty($request['service'])){
            if($corporate = Corporate::find($id)) {
                Corporate::where('id',$id)->update([
                    'program_id' => $request['program_id'],
                    'diplom_id' => $request['diplom_id'],
                    'status' => $request['status'],
                    'proposal' => $request['proposal'],
                    'next_call' => $request['next_call'],
                    'training_course_id' => $request['training_course_id'],
                ]);
            }
        }

        if($activity){
            $file = $request->file('proposal');
            $document = $request->file('document');
            $path = public_path('images/corporates/documents/');
            if($file != null) {
                $extension = $file->getClientOriginalExtension();
                if($extension != 'pdf'){
                    $oldFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $fileName = $request['service'] .'-'.$now.'-'. Str::random(5).'.'.$extension;
                    Image::make($file->getRealPath())->resize(3508, 2480)->save( public_path('images/corporates/documents/' . $fileName ));
                    CorporateActivity::where('id',$activity->id)->update([
                        'proposal' => $fileName,
                    ]);
                }else{
                    $fileName = Uploader::upload($file,$path);
                    CorporateActivity::where('id',$activity->id)->update([
                        'proposal' => $fileName,
                    ]);
                }
                
            }
            if($document != null) {
                $extension = $document->getClientOriginalExtension();
                if($extension != 'pdf'){
                    $oldDocumentName = pathinfo($document->getClientOriginalName(), PATHINFO_FILENAME);
                    $documentName = $request['service'] .'-'.$now.'-'. Str::random(5).'.'.$extension;
                    Image::make($document->getRealPath())->resize(3508, 2480)->save( public_path('images/corporates/documents/' . $fileName ));
                    CorporateActivity::where('id',$activity->id)->update([
                        'document' => $documentName,
                    ]);
                }else{
                    $documentName = Uploader::upload($document,$path);
                    CorporateActivity::where('id',$activity->id)->update([
                        'document' => $documentName,
                    ]);
                }
                
            }
            return ['data' => $activity];
        }       
    }
}