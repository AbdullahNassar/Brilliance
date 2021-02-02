<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentDocument extends Model
{
    use SoftDeletes;
    protected $table = 'student_documents';
    protected $fillable = ['file','student_id','document_id','url'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function requiredDocument()
    {
        return $this->belongsTo(StudentRequiredDocument::class);
    }
}
