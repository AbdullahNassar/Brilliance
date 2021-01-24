<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrainingCourse extends Model
{
    use SoftDeletes;
    protected $table = 'training_courses';
    protected $fillable = ['name','corporate_id','category_id','status'];

    public function category()
    {
        return $this->belongsTo(TrainingCategory::class,'category_id');
    }

    public function corporate()
    {
        return $this->belongsTo(Corporate::class,'corporate_id');
    }

    public function activities()
    {
        return $this->hasMany(CorporateActivity::class,'training_course_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class,'doctor_id');
    }
}
