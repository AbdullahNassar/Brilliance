<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentExperience extends Model
{
    use SoftDeletes;
    protected $table = 'student_experience';
    protected $fillable = ['logo','position','department','business_unit','location','employer','industry','head_count',
    'type','co_street','co_area','co_city','co_landmark','co_country','co_website','co_email','co_mobile','co_fax',
    'h_street','h_area','h_city','h_landmark','h_country','h_website','h_email','h_mobile','h_fax','student_id'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function studentCorporateContact()
    {
        return $this->hasMany(StudentCorporateContact::class,'student_experience_id');
    }
}
