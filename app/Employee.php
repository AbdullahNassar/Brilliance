<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Employee extends Model
{
    use SoftDeletes,HasRoles;
    protected $table = 'employees';
    protected $fillable = ['name','middle_name','last_name','gender','job','image','mobile1','mobile2','email1','email2',
    'national_id','street','area','city','country','balance','salary','degree','major','faculty','university','grade',
    'user_id','status'];

    public function employeeDocuments()
    {
        return $this->hasMany(EmployeeDocument::class,'employee_id');
    }
}
