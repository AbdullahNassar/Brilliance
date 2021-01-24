<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DoctorDiplomCourse extends Model
{
    use SoftDeletes;
    protected $table = 'diplom_course_doctor';
    protected $fillable = ['doctor_id','diplom_course_id'];

    public function diplomCourses()
    {
        return $this->hasMany(DiplomCourse::class,'diplom_course_id');
    }

    public function doctors()
    {
        return $this->hasMany(Doctor::class,'doctor_id');
    }
}
