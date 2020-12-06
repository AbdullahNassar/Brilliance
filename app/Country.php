<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model 
{
    use Translatable,SoftDeletes;
    protected $table = 'countries';
    protected $fillable = ['image','flag','code'];
    public $translatedAttributes = ['name'];
    public $translationForeignKey = 'country_id';
    
    public function translations()
    {
        return $this->hasMany(CountryTranslation::class,'country_id');
    }

    public function universities()
    {
        return $this->hasMany(University::class);
    }

    public function programs()
    {
        return $this->hasMany(Program::class);
    }
    
}
