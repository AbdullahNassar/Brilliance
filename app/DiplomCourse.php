<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiplomCourse extends Model
{
    use SoftDeletes;
    protected $table = 'diplom_courses';
    protected $fillable = ['name','diplom_id','active','credits'];

    public function diplom()
    {
        return $this->belongsTo(Diplom::class);
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
