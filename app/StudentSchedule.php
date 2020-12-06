<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentSchedule extends Model
{
    use SoftDeletes;
    protected $table = 'student_schedule';
    protected $fillable = ['date','time','student_id','program_id','program_intake_id',
    'program_course_id','diplom_intake_id','diplom_course_id'];

    public function student()
    {
        return $this->belongsTo(ProgramIntake::class);
    }

    public function programCourses()
    {
        return $this->belongsTo(ProgramCourse::class);
    }

    public function diplomIntakes()
    {
        return $this->belongsTo(DiplomIntake::class);
    }

    public function diplomCourses()
    {
        return $this->belongsTo(DiplomCourse::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function diplom()
    {
        return $this->belongsTo(Diplom::class);
    }
}
