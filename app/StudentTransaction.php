<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentTransaction extends Model
{
    use SoftDeletes;
    protected $table = 'student_transactions';
    protected $fillable = ['date','egp_amount','usd_amount','euro_amount','egp_paid','usd_paid',
                           'euro_paid','egp_balance','usd_balance','euro_balance','student_id',
                            'student_payment_id'];

    public function student()
    {
        return $this->belongsTo(Student::class,'student_id');
    }

    public function studentPayment()
    {
        return $this->belongsTo(StudentPayment::class,'student_payment_id');
    }
}
