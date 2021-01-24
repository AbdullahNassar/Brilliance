<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesTicket extends Model
{
    use SoftDeletes;
    protected $table = 'sales_tickets';
    protected $fillable = ['source','study','full_name','job_title','company_name',
                           'phone_number','email','status','sales_id','program_id','diplom_id',
                           'user_id','others'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function advisor()
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
}
