<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use SoftDeletes;
    protected $table = 'programs';
    protected $fillable = ['name','university_id','active'];

    public function intakes()
    {
        return $this->hasMany(ProgramIntake::class,'program_id');
    }

    public function courses()
    {
        return $this->hasMany(ProgramCourse::class,'program_id');
    }

    public function university()
    {
        return $this->belongsTo(University::class,'university_id');
    }

    public function leads()
    {
        return $this->hasMany(SalesLead::class,'program_id');
    }

    public function corporates()
    {
        return $this->hasMany(Corporate::class,'program_id');
    }

    public function activities()
    {
        return $this->hasMany(CorporateActivity::class,'program_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class,'program_id');
    }
    
    public function doctors()
    {
        return $this->hasMany(Doctor::class,'program_id');
    }
}
