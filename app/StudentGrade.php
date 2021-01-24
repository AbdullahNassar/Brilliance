<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentGrade extends Model
{
    use SoftDeletes;
    protected $table = 'student_grades';
    protected $fillable = ['attendance','assignment','final_exam','total','grade','student_id',
    'program_intake_id','diplom_intake_id','program_course_id','diplom_course_id','doctor_id'];

    public function student()
    {
        return $this->belongsTo(Student::class,'student_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class,'doctor_id');
    }

    public function diplomIntake()
    {
        return $this->belongsTo(DiplomIntake::class,'diplom_intake_id');
    }

    public function programIntake()
    {
        return $this->belongsTo(ProgramIntake::class,'program_intake_id');
    }

    public function diplomCourse()
    {
        return $this->belongsTo(DiplomCourse::class,'diplom_course_id');
    }

    public function programCourse()
    {
        return $this->belongsTo(ProgramCourse::class,'program_course_id');
    }
}
