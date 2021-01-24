<?php

namespace App\Http\Controllers\Site\Universities;

use App\Http\Controllers\Admin\MainController;
use App\UniversityTranslation;
use App\Category;
use App\SubCategory;
use App\Program;
use App\University;
use App\Language;
use App\Country;
use App\UniversityImage;
use Illuminate\Http\Request;
use DateTime;
use DB;


class UniversitiesController extends MainController
{
    public $model = University::class;

    public static function universities(){
        $universities = University::where('status', 1)->get();
        $universitiesCount = $universities->count();
        return view('site.pages.universities.index', compact('universities','universitiesCount'));
    }

    public static function university($id,$slug){
        $university = University::find($id);
        if($university){
            $slug = UniversityTranslation::where('university_id', $id)->where('slug', $slug)->first();
            if($slug){
                $logo = UniversityImage::where('university_id',$id)
                            ->where('code','logo')->first();
                $cover = UniversityImage::where('university_id',$id)
                            ->where('code','cover')->first();
                $categories = Program::orderBy('id', 'desc')->groupBy('category_id')->where('university_id',$id)->get();
                $category = SubCategory::get();
                $categoriesCount = $category->count();
                $programsCount = Program::where('university_id',$id)->get();
                $programs = $programsCount->count();
                $master_programs = Program::where('degree','Master')->where('status',1)->where('university_id',$id)->get();
                $count1 = $master_programs->count();
                $master_programs_cat = Program::where('degree','Master')->where('status',1)->where('university_id',$id)->groupBy('category_id')->get();
                $bachelor_programs = Program::where('degree','Bachelor')->where('status',1)->where('university_id',$id)->get();
                $bachelor_programs_cat = Program::where('degree','Bachelor')->where('status',1)->where('university_id',$id)->groupBy('category_id')->get();
                $count2 = $bachelor_programs->count();
                $phd_programs = Program::where('degree','PHD')->where('status',1)->where('university_id',$id)->get();
                $phd_programs_cat = Program::where('degree','PHD')->where('status',1)->where('university_id',$id)->groupBy('category_id')->get();
                $count3 = $phd_programs->count();
                $postdoc_programs = Program::where('degree','PostDoc')->where('status',1)->where('university_id',$id)->get();
                $postdoc_programs_cat = Program::where('degree','PostDoc')->where('status',1)->where('university_id',$id)->groupBy('category_id')->get();
                $count4 = $postdoc_programs->count();
                $diploma_programs = Program::where('degree','Diploma')->where('status',1)->where('university_id',$id)->get();
                $diploma_programs_cat = Program::where('degree','Diploma')->where('status',1)->where('university_id',$id)->groupBy('category_id')->get();
                $count5 = $diploma_programs->count();
                return view('site.pages.university.index', compact('diploma_programs','postdoc_programs','phd_programs','bachelor_programs','master_programs',
                'programs','university','logo','cover','count1','count2','count3','count4','count5','categories','categoriesCount','master_programs_cat',
                'diploma_programs_cat','postdoc_programs_cat','phd_programs_cat','bachelor_programs_cat'));
            }else{
                return redirect('/programs');
            }
        }else{
            return redirect('/programs');
        }
            
    }

    function load_data(Request $request)
    {
        if($request->ajax())
        {
            if($request->id > 0)
            {
                $data = University::where('id', '<', $request->id)->where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
            }
            else
            {
                $data = University::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
            }
            $output = '';
            $last_id = '';
            
            if(!$data->isEmpty())
            {
                foreach($data as $university)
                {
                    $programs = Program::where('university_id',$university->id)->get();
                    $programsCount = $programs->count();
                    $logo = UniversityImage::where('university_id',$university->id)
                    ->where('code','logo')->first();
                    $cover = UniversityImage::where('university_id',$university->id)
                    ->where('code','cover')->first();
                    $logo_img = asset('images/universities/'.$logo->image);
                    $cover_img = asset('images/universities/'.$cover->image);
                    $img = asset('vendors/site/img/university1.png');
                    $output .= '
                    <div class="col-xs-12 remove-padding univer-main">
                        <div class="col-xs-12 univer-head remove-padding">
                            <img src="'.$cover_img.'">
                            <!--<a href="'.$university->map_url.'">View On Map</a>-->
                        </div>

                        <div class="col-xs-12 remove-padding univer-info">
                            <img src="'.$logo_img.'">
                            <h1>'.$university->translate(app()->getLocale(), true)->name.'</h1>
                            <h4><span class="icon-50location"></span> '.$university->country->translate(app()->getLocale(), true)->name.'</h4>
                            <div class="unver-number">
                                <div class="unver-number-item">
                                    <h3>34</h3>
                                    <p>'.trans('main.World_Rank').'</p>
                                </div>

                                <div class="unver-number-item">
                                    <h3>'.$programsCount.'</h3>
                                    <p>'.trans('main.Programs').'</p>
                                </div>

                                <div class="unver-number-item">
                                    <h3>'.$university->number_of_students.'</h3>
                                    <p>'.trans('main.Student').'</p>
                                </div>
                            </div>

                            <div class="col-xs-12 remove-padding univer-fot">
                                <a href="'.route('university' , ['id'=>$university->id ,'slug' => $university->translate(app()->getLocale(), true)->slug]).'"><img src="'.$img.'">'.trans('main.visitsunvertys').'</a>
                            </div>

                        </div>

                    </div>
                    ';
                    $last_id = $university->id;
                }
                $output .= '
                    <div id="load_more">
                        <button type="button" name="load_more_button" class="btn btn-success form-control" data-id="'.$last_id.'" id="load_more_button">'.trans('main.load_more').'</button>
                    </div>
                    ';
            }
            else
            {
                $output .= '
                <div id="load_more">
                    <button type="button" name="load_more_button" class="btn btn-info form-control">'.trans('main.no_data').'</button>
                </div>
                ';
            }
            echo $output;
        }
    }
}