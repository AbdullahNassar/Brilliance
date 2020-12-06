<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgramIntake extends Model
{
    use SoftDeletes;
    protected $table = 'program_intakes';
    protected $fillable = ['name','status','start','program_id','active'];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
