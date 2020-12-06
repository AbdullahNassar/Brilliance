<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiplomCourse extends Model
{
    use SoftDeletes;
    protected $table = 'diplom_courses';
    protected $fillable = ['name','diplom_id','active'];

    public function diplom()
    {
        return $this->belongsTo(Diplom::class);
    }
}
