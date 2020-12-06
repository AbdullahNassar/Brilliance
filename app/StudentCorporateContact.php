<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentCorporateContact extends Model
{
    use SoftDeletes;
    protected $table = 'student_corporate_contacts';
    protected $fillable = ['name','position','email','mobile','student_experience_id'];

    public function studentExperience()
    {
        return $this->belongsTo(StudentExperience::class);
    }
}
