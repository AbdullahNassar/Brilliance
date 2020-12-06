<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiplomIntake extends Model
{
    use SoftDeletes;
    protected $table = 'diplom_intakes';
    protected $fillable = ['name','status','start','diplom_id','active'];

    public function diplom()
    {
        return $this->belongsTo(Diplom::class);
    }
}
