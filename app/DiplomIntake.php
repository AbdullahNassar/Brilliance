<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiplomIntake extends Model
{
    use SoftDeletes;
    protected $table = 'diplom_intakes';
    protected $fillable = ['name','status','start','diplom_id','active','doctor_id'];

    public function diplom()
    {
        return $this->belongsTo(Diplom::class,'diplom_id');
    }

    public function schedule()
    {
        return $this->hasMany(StudentSchedule::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class,'diplom_intake_id');
    }
    
    public function doctor()
    {
        return $this->belongsTo(Doctor::class,'doctor_id');
    }

    public function studentGrades()
    {
        return $this->hasMany(StudentGrade::class,'diplom_intake_id');
    }
}
