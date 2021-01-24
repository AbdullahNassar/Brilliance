<?php

namespace App\Imports;

use App\SalesLead;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Auth;

class SalesLeadsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {
        $phone_number = SalesLead::where('phone_number',$row[7])->first();
        $email = SalesLead::where('email',$row[8])->first();
        if(!$phone_number && !$email && $row[0] != 'created_time' && $row[1] != 'campaign_name' && $row[2] != 'form_name' && $row[3] != 'platform' && $row[4] != 'full_name' && $row[5] != 'job_title' && $row[6] != 'company_name' && $row[7] != 'phone_number' && $row[8] != 'email'){
            return new SalesLead([
                "created_time"=>$row[0],
                "campaign_name"=>$row[1],
                "form_name"=>$row[2],
                "platform"=>$row[3],
                "full_name"=>$row[4],
                "job_title"=>$row[5],
                "company_name"=>$row[6],
                "phone_number"=>$row[7],
                "email"=>$row[8],
                "sales_id"=>Auth::user()->id,
                "status"=>0
            ]);
        }
    }
}