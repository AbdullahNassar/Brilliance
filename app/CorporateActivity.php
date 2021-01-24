<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CorporateActivity extends Model
{
    use SoftDeletes;
    protected $table = 'corporate_activities';
    protected $fillable = ['proposal','service','status','next_call','notes','user_id','program_id','diplom_id','corporate_id','training_course_id'];

    public function corporate()
    {
        return $this->belongsTo(Corporate::class,'corporate_id');
    }

    public function course()
    {
        return $this->belongsTo(TrainingCourse::class,'training_course_id');
    }

    public function program()
    {
        return $this->belongsTo(Program::class,'program_id');
    }

    public function diplom()
    {
        return $this->belongsTo(Diplom::class,'diplom_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
