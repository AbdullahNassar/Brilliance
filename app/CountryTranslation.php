<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CountryTranslation extends Model
{
    protected $table = 'countries_translations';
    protected $fillable = ['name'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}