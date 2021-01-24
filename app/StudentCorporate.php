<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentCorporate extends Model
{
    use SoftDeletes;
    protected $table = 'corporate_student';
    protected $fillable = ['from','to','student_id','corporate_id','position'];

    public function students()
    {
        return $this->hasMany(Student::class,'student_id');
    }

    public function corporates()
    {
        return $this->hasMany(Corporate::class,'corporate_id');
    }
}
