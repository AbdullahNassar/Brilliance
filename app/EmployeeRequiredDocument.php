<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentRequiredDocument extends Model
{
    use SoftDeletes;
    protected $table = 'student_required_documents';
    protected $fillable = ['name'];

    public function studentDocuments()
    {
        return $this->hasMany(StudentDocument::class,'document_id');
    }
}
