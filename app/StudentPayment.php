<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentPayment extends Model
{
    use SoftDeletes;
    protected $table = 'student_payment';
    protected $fillable = ['date','name','egp_amount','usd_amount','euro_amount','egp_paid',
                           'usd_paid','euro_paid','egp_balance','usd_balance','euro_balance',
                           'paid','student_id'];

    public function student()
    {
        return $this->belongsTo(Student::class,'student_id');
    }

    public function transactions()
    {
        return $this->hasMany(StudentTransaction::class,'student_payment_id');
    }
}
