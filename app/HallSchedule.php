<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HallSchedule extends Model
{
    use SoftDeletes;
    protected $table = 'hall_schedule';
    protected $fillable = ['date','hall_id','time_from','time_to','doctor_id',
                           'program_course_id','diplom_course_id','training_course_id','type'];

    public function hall()
    {
        return $this->belongsTo(Hall::class,'hall_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class,'hall_id');
    }

    public function programCourse()
    {
        return $this->belongsTo(ProgramCourse::class,'program_course_id');
    }

    public function diplomCourse()
    {
        return $this->belongsTo(DiplomCourse::class,'diplom_course_id');
    }

    public function trainingCourse()
    {
        return $this->belongsTo(TrainingCourse::class,'training_course_id');
    }
}
