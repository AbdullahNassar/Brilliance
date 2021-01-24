<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MarketingLead extends Model
{
    use SoftDeletes;
    protected $table = 'marketing_leads';
    protected $fillable = ['created_time','campaign_name','form_name','platform','full_name','job_title','company_name',
                            'phone_number','email','status','marketing_id'];

    public function user()
    {
        return $this->belongsTo(User::class,'marketing_id');
    }
}
