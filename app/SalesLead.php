<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesLead extends Model
{
    use SoftDeletes;
    protected $table = 'sales_leads';
    protected $fillable = ['created_time','campaign_name','form_name','platform','full_name','job_title','company_name',
                            'phone_number','email','status','activity_status','next_call','study','sales_id','program_id','diplom_id'];

    public function user()
    {
        return $this->belongsTo(User::class,'sales_id');
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function diplom()
    {
        return $this->belongsTo(Diplom::class);
    }

    public function salesActivities()
    {
        return $this->hasMany(SalesActivity::class,'sales_lead_id');
    }
}
