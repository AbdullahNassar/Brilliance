<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeDocument extends Model
{
    use SoftDeletes;
    protected $table = 'employee_documents';
    protected $fillable = ['file','employee_id','document_id','url'];

    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id');
    }

    public function requiredDocument()
    {
        return $this->belongsTo(EmployeeRequiredDocument::class,'document_id');
    }
}
