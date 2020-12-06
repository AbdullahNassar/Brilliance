<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;
    protected $table = 'students';
    protected $fillable = ['name','middle_name','last_name','gender','job','image','location','mobile1','mobile2','email1','email2',
    'national_id','street','area','city','country','em_name','em_relation','em_mobile','em_email','description',
    'group_admission','balance','reference','degree','major','faculty','university','grade',
    'date','statement','program_id','diplom_id','university_id','program_intake_id','diplom_intake_id',
    'user_id'];

    public function programIntakes()
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

    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function diplom()
    {
        return $this->belongsTo(Diplom::class);
    }

    public function studentSchedules()
    {
        return $this->hasMany(StudentSchedule::class,'student_id');
    }

    public function studentDocuments()
    {
        return $this->hasMany(StudentDocument::class,'student_id');
    }

    public function studentExperience()
    {
        return $this->hasMany(StudentExperience::class,'student_id');
    }
}
