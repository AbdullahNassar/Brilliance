<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentCourse extends Model
{
    use SoftDeletes;
    protected $table = 'student_courses';
    protected $fillable = ['student_id','doctor_id','program_course_id','diplom_course_id'];

    public function student()
    {
        return $this->belongsTo(Student::class,'student_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class,'doctor_id');
    }

    public function programCourse()
    {
        return $this->belongsTo(ProgramCourse::class,'program_course_id');
    }

    public function diplomCourse()
    {
        return $this->belongsTo(DiplomCourse::class,'diplom_course_id');
    }
}
