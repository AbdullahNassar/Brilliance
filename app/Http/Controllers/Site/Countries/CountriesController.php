<?php

namespace App\Http\Controllers\Site\Countries;

use App\Http\Controllers\Admin\MainController;
use App\Country;
use Illuminate\Http\Request;
use DateTime;
use DB;


class CountriesController extends MainController
{
    public $model = Country::class;

    public static function countries(){
        $countries = Country::all();
        return view('site.pages.countries.index', compact('countries'));
    }
}