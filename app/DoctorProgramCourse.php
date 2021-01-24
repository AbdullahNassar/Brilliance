<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DoctorProgramCourse extends Model
{
    use SoftDeletes;
    protected $table = 'doctor_program_course';
    protected $fillable = ['doctor_id','program_course_id'];

    public function programCourses()
    {
        return $this->hasMany(ProgramCourse::class,'program_course_id');
    }

    public function doctors()
    {
        return $this->hasMany(Doctor::class,'doctor_id');
    }
}
