<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgramCourse extends Model
{
    use SoftDeletes;
    protected $table = 'program_courses';
    protected $fillable = ['name','program_id','active'];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
