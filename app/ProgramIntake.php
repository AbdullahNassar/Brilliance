<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgramIntake extends Model
{
    use SoftDeletes;
    protected $table = 'program_intakes';
    protected $fillable = ['name','status','start','program_id','active','doctor_id'];

    public function program()
    {
        return $this->belongsTo(Program::class,'program_id');
    }

    public function schedule()
    {
        return $this->hasMany(StudentSchedule::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class,'program_intake_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class,'doctor_id');
    }

    public function studentGrades()
    {
        return $this->hasMany(StudentGrade::class,'program_intake_id');
    }
}
