<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DoctorTrainingCourse extends Model
{
    use SoftDeletes;
    protected $table = 'doctor_training_course';
    protected $fillable = ['doctor_id','training_course_id'];

    public function trainingCourses()
    {
        return $this->hasMany(TrainingCourse::class,'training_course_id');
    }

    public function doctors()
    {
        return $this->hasMany(Doctor::class,'doctor_id');
    }
}
