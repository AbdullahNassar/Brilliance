<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeRequiredDocument extends Model
{
    use SoftDeletes;
    protected $table = 'employee_required_documents';
    protected $fillable = ['name'];

    public function employeeDocuments()
    {
        return $this->hasMany(EmployeeDocument::class,'document_id');
    }
}
