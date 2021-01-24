<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CorporateContact extends Model
{
    use SoftDeletes;
    protected $table = 'corporate_contacts';
    protected $fillable = ['name','email','position','mobile','corporate_id','default'];

    public function corporate()
    {
        return $this->belongsTo(Corporate::class,'corporate_id');
    }
}
