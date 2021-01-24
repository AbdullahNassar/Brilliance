<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Doctor extends Model
{
    use SoftDeletes,HasRoles;
    protected $table = 'doctors';
    protected $fillable = ['name','image','mobile','email','national_id','cv','fees_per_day',
    'total_fees','degree','major','faculty','university','grade','date','program_id',
    'program_intake_id','program_course_id','diplom_id','diplom_intake_id','diplom_course_id',
    'training_course_id','notes','service'];

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
        return $this->belongsToMany(TrainingCourse::class);
    }

    public function programintake()
    {
        return $this->belongsTo(ProgramIntake::class,'program_intake_id');
    }

    public function programCourses()
    {
        return $this->belongsToMany(ProgramCourse::class);
    }

    public function diplomintake()
    {
        return $this->belongsTo(DiplomIntake::class,'diplom_intake_id');
    }

    public function diplomCourses()
    {
        return $this->belongsToMany(DiplomCourse::class);
    }

    public function doctorSchedules()
    {
        return $this->hasMany(DoctorSchedule::class,'doctor_id');
    }
}
