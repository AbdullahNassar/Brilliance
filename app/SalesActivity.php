<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesActivity extends Model
{
    use SoftDeletes;
    protected $table = 'sales_activities';
    protected $fillable = ['type','status','next_call','notes','sales_id','sales_lead_id'];

    public function user()
    {
        return $this->belongsTo(User::class,'sales_id');
    }

    public function salesLead()
    {
        return $this->belongsTo(SalesLead::class,'sales_lead_id');
    }
}
