<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Corporate extends Model
{
    use SoftDeletes;
    protected $table = 'corporates';
    protected $fillable = ['source','source_note','name','logo','industry','street','area','city','landmark','country',
                            'website','email','mobile','fax','status','user_id','program_id','diplom_id',
                            'training_course_id'];

    public function activities()
    {
        return $this->hasMany(CorporateActivity::class,'corporate_id');
    }

    public function contacts()
    {
        return $this->hasMany(CorporateContact::class,'corporate_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class,'student_id');
    }

    public function course()
    {
        return $this->belongsTo(TrainingCourse::class,'training_course_id');
    }

    public function program()
    {
        return $this->belongsTo(Program::class,'program_id');
    }

    public function diplom()
    {
        return $this->belongsTo(Diplom::class,'diplom_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function corporateStudents()
    {
        return $this->belongsToMany(Student::class)->withPivot('from', 'to','position');
    }

    public function studentCorporate()
    {
        return $this->belongsTo(StudentCorporate::class,'corporate_id');
    }
}
