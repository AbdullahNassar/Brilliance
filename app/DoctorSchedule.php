<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DoctorSchedule extends Model
{
    use SoftDeletes;
    protected $table = 'doctor_schedule';
    protected $fillable = ['date','time_from','time_to','student_id','program_id','program_intake_id',
    'program_course_id','diplom_id','diplom_intake_id','diplom_course_id','training_course_id',
    'notes','service','doctor_id'];

    public function student()
    {
        return $this->belongsTo(Student::class,'student_id');
    }

    public function programCourse()
    {
        return $this->belongsTo(ProgramCourse::class,'program_course_id');
    }

    public function diplomCourse()
    {
        return $this->belongsTo(DiplomCourse::class,'diplom_course_id');
    }

    public function diplomIntake()
    {
        return $this->belongsTo(DiplomIntake::class,'diplom_intake_id');
    }

    public function programIntake()
    {
        return $this->belongsTo(ProgramIntake::class,'program_intake_id');
    }

    public function program()
    {
        return $this->belongsTo(Program::class,'program_id');
    }

    public function diplom()
    {
        return $this->belongsTo(Diplom::class,'diplom_id');
    }

    public function training()
    {
        return $this->belongsTo(TrainingCourse::class,'training_course_id');
    }
}
