<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cash extends Model
{
    use SoftDeletes;
    protected $table = 'cash';
    protected $fillable = ['date','currency','description','type','amount','student_id'];

    public function student()
    {
        return $this->belongsTo(Student::class,'student_id');
    }
}
