<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrainingCategory extends Model
{
    use SoftDeletes;
    protected $table = 'training_categories';
    protected $fillable = ['name','status'];

    public function trainingCourses()
    {
        return $this->hasMany(TrainingCourse::class,'category_id');
    }
}
