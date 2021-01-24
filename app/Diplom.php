<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Diplom extends Model
{
    use SoftDeletes;
    protected $table = 'diploms';
    protected $fillable = ['name','university_id','active'];

    public function intakes()
    {
        return $this->hasMany(diplomIntake::class,'diplom_id');
    }

    public function courses()
    {
        return $this->hasMany(diplomCourse::class,'diplom_id');
    }

    public function university()
    {
        return $this->belongsTo(University::class,'university_id');
    }

    public function leads()
    {
        return $this->hasMany(SalesLead::class,'diplom_id');
    }

    public function corporates()
    {
        return $this->hasMany(Corporate::class,'diplom_id');
    }

    public function activities()
    {
        return $this->hasMany(CorporateActivity::class,'diplom_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
    
    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
}
