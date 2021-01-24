<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hall extends Model
{
    use SoftDeletes;
    protected $table = 'halls';
    protected $fillable = ['name','active'];

    public function schedule()
    {
        return $this->hasMany(HallSchedule::class,'hall_id');
    }
}
