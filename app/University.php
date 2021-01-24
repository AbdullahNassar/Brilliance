<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class University extends Model
{
    use SoftDeletes;
    protected $table = 'universities';
    protected $fillable = ['name','active'];

    public function programs()
    {
        return $this->hasMany(Program::class,'university_id');
    }

    public function diploms()
    {
        return $this->hasMany(Diplom::class,'university_id');
    }
}
