<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgramCourse extends Model
{
    use SoftDeletes;
    protected $table = 'program_courses';
    protected $fillable = ['name','program_id','active','credits'];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function schedule()
    {
        return $this->hasMany(StudentSchedule::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
    
    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    public function studentCourse()
    {
        return $this->hasMany(StudentCourse::class);
    }
}
