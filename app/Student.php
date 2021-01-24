<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Student extends Model
{
    use SoftDeletes,HasRoles;
    protected $table = 'students';
    protected $fillable = ['name','middle_name','last_name','gender','job','image','location','mobile1','mobile2','email1','email2',
    'national_id','street','area','city','country','em_name','em_relation','em_mobile','em_email','description',
    'group_admission','balance','reference','degree','major','faculty','university','grade','type','source',
    'source_note','application_fees','discount_rate','total_egp','total_usd','total_euro','notes','diplom_intake_id',
    'date','statement','program_id','diplom_id','university_id','program_intake_id','training_course_id',
    'user_id','corporate_id','service','service_note','lead_id','program_course_id','status'];

    public function programintake()
    {
        return $this->belongsTo(ProgramIntake::class,'program_intake_id');
    }

    public function programCourses()
    {
        return $this->belongsTo(ProgramCourse::class,'program_course_id');
    }

    public function diplomintake()
    {
        return $this->belongsTo(DiplomIntake::class,'diplom_intake_id');
    }

    public function diplomCourses()
    {
        return $this->belongsTo(DiplomCourse::class,'diplom_course_id');
    }

    public function corporate()
    {
        return $this->belongsTo(Corporate::class,'corporate_id');
    }

    public function studentCorporates()
    {
        return $this->belongsToMany(Corporate::class)->withPivot('from', 'to','position');
    }

    public function university()
    {
        return $this->belongsTo(University::class,'university_id');
    }

    public function program()
    {
        return $this->belongsTo(Program::class,'program_id');
    }

    public function diplom()
    {
        return $this->belongsTo(Diplom::class,'diplom_id');
    }

    public function studentSchedules()
    {
        return $this->hasMany(StudentSchedule::class,'student_id');
    }

    public function studentProgress()
    {
        return $this->hasMany(StudentProgress::class,'student_id');
    }

    public function studentCourses()
    {
        return $this->hasMany(StudentCourse::class,'student_id');
    }

    public function studentDocuments()
    {
        return $this->hasMany(StudentDocument::class,'student_id');
    }

    public function lead()
    {
        return $this->belongsTo(SalesLead::class,'lead_id');
    }

    public function grade()
    {
        return $this->belongsTo(StudentGrade::class,'student_id');
    }

    public function payments()
    {
        return $this->hasMany(StudentPayment::class,'student_id');
    }

    public function transactions()
    {
        return $this->hasMany(StudentTransaction::class,'student_id');
    }

    public function cash()
    {
        return $this->hasMany(Cash::class,'student_id');
    }
}
