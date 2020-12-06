<?php

namespace App\Http\Controllers\Site\Programs;

use App\Http\Controllers\Admin\MainController;
use App\Http\Requests\Program\StoreProgramSpeakRequest;
use App\Http\Requests\Program\StoreProgramReportRequest;
use PragmaRX\Countries\Package\Countries;
use App\Helpers\Request as RequestHelper;
use App\ProgramReport;
use App\ProgramTranslation;
use App\Program;
use App\ProgramLanguage;
use App\ProgramBenefit;
use App\ProgramLanguageTest;
use App\ProgramAdmission;
use App\Category;
use App\SubCategory;
use App\University;
use App\Language;
use App\Country;
use App\Start;
use App\Speaker;
use App\Deadline;
use App\UniversityImage;
use Illuminate\Http\Request;
use DateTime;
use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Facades\Input;
use Jenssegers\Date\Date;
use Illuminate\Support\Str;


class ProgramsController extends MainController
{
    public $model = Program::class;

    public static function programs(Request $request){
        if($request->session()->exists('ids[]')) {
            if(! isset($request->page) || $request->page <= 1) {
                $request->session()->forget('ids[]');
            }
        }
        $session_ids = $request->session()->exists('ids[]') ? $request->session()->get('ids[]') : [];
        $session_ids = is_array($session_ids) ? $session_ids : [];
        
        $all_programs_count =  Program::where('status', 1)->count();
        $paginate = 12;
        $last_page = ceil($all_programs_count / $paginate);
            
        $programs = Program::where('status', 1)->inRandomOrder()->whereNotIn('id', $session_ids)->limit($paginate)->get();
        foreach($programs as $program) {
            $request->session()->push('ids[]', $program->id);
        }
            
        $programsCount = Program::where('status', 1)->count();
        $countries = Country::all();
        $subCategories = SubCategory::all();
        
        $next_page = $request->page ? $request->page + 1 : 2;
        $next_page_url = $request->fullUrlWithQuery(['page' => $next_page]);
        $next_page_url = $next_page > $last_page ? null : $next_page_url;
        
        if ($request->ajax()) {
            return [
                'programs' => view('site.pages.programs.ajax', compact('programs','programsCount','countries','subCategories'))->render(),
                'next_page' => $next_page_url,
                'ids' => $session_ids,
            ];
            
        }
        return view('site.pages.programs.index', compact('programs','programsCount','countries','subCategories', 'next_page_url'));
    }

    public static function search(Request $request){
        $delivery_mode = $request->input('online');
        $discount = $request->input('discount');
        $degree_input = $request->input('degree'); //array
        $country_input = $request->input('country'); //array
        $sub_category_input = $request->input('sub_category'); //array
        $duration = $request->input('duration');
        $full = $request->input('full');
        $part = $request->input('part');
        $fees_from = $request->input('fees_from');
        $fees_to = $request->input('fees_to');
        $test = $request->input('test');
        $countries = Country::all();
        $subCategories = SubCategory::all();

        $programs = (new \App\Program)->newQuery();
        
        if($request->has('part') && $request->has('full') && $part == 1 && $full == 1 && $request->has('fees_from') && $request->has('fees_to') && $request->has('country')){
            $programs->whereIn('country_id', $country_input);
        }else{
            if($request->has('test') && $test == 1) {
                $programs->where('test','!=', 1);
            }
    
            if($request->has('degree')){
                $programs->whereIn('degree', $degree_input);
            }
            if($request->has('country')){
                $programs->whereIn('country_id', $country_input);
            }
            if($request->has('sub_category')){
                $programs->whereIn('sub_category_id', $sub_category_input);
            }
    
            if($request->has('part') && $part == 1){
                $programs->where('study_type','=','Part-Time');
            }
            if($request->has('full') && $full == 1){
                $programs->where('study_type','=','Full-Time');
            }
    
            //Duration\\
            if($request->has('duration')){
                if($duration == 'all'){
                    $programs->where('duration','>', 0);
                }elseif($duration == 'month'){
                    $programs->where('duration_type', 'day')->where('duration_type', 'week')
                                        ->where('duration','<',30);
                }elseif($duration == 'monthes'){
                    $programs->where('duration_type', 'month')->where('duration','<',6);
                }elseif($duration == 'year'){
                    $programs->where('duration_type', 'year')->where('duration','>',0);
                }
            }
    
            if($request->has('online') && $delivery_mode == 1) {
                $programs->where('guarantee', '1');
            }
    
            if($request->has('discount') && $discount == 1) {
                $programs->where('discount','>', 0);
            }
    
            if($request->has('fees_from') && $request->has('fees_to')) {
                $programs->where('fees','>=' ,$fees_from)->where('fees', '<=',$fees_to);
            }
        }

        
        $programs = $programs->where('status', 1)->inRandomOrder()->get();
        $programsCount = $programs->count();
        //$programs = $programs->appends(Input::except('page'));
        return view('site.pages.programs.search.index', compact(
            'delivery_mode','discount','degree_input','country_input','sub_category_input','duration','full',
            'part','fees_from','fees_to','test','countries','subCategories','programs','programsCount'));
    }

    public static function program($id,$slug){
        $program = Program::find($id);
        if($program){
            $slug = ProgramTranslation::where('program_id', $id)->where('slug', $slug)->first();
            if($slug){
                $programs = Program::where('university_id',$program->university_id)->get();
                            $programsCount = $programs->count();
                if($program->duration == 1)
                    $duration = trans("main.$program->duration_type");
                elseif($program->duration > 1)
                    $duration = trans("main.$program->duration_type"."s");

                $now = Carbon::now();
                $start = Start::where('program_id', $id)->where('date','>', $now)->first();
                $deadline = Deadline::where('program_id', $id)->first();

                $logo = UniversityImage::where('university_id',$program->university_id)
                            ->where('code','logo')->first();
                $cover = UniversityImage::where('university_id',$program->university_id)
                            ->where('code','image')->first();
                $countries = Country::all();
                $programAdmissions = ProgramAdmission::where('program_id', $id)->where('name_en','!=', null)->get();
                $admissions = $programAdmissions->count();
                $ProgramLanguageTest = ProgramLanguageTest::where('program_id', $id)->where('test_id', '!=', null)->get();
                $tests = $ProgramLanguageTest->count();
                $ProgramBenefit = ProgramBenefit::where('program_id', $id)->where('benefit', '!=', null)->get();
                $benefits = $ProgramBenefit->count();
                $ProgramLanguage = ProgramLanguage::where('program_id', $id)->where('language_id', '!=', null)->get();
                $languages = $ProgramLanguage->count();
                
                return view('site.pages.program.index', compact('now','duration','languages','admissions','benefits','tests','countries','program','start','deadline','logo','cover','programsCount'));
            }else{
                return redirect('/programs');
            }
        }else{
            return redirect('/admin/programs');
        }
    }

    function load_data(Request $request)
    {
        if($request->ajax())
        {
            $ids = [];
            $data = Program::where('status', 1)->inRandomOrder()->limit(12)->get();
            $newdata = Program::where('status', 1);
            $newcount= $data->count();
            $counter = $newdata->count();
            //dd($counter);
            $output = '';
            if($request->id > 0)
            $last_id = $request->id;
            else
            $last_id = 0;

            if(!$data->isEmpty() && $last_id < $counter)
            {
                foreach($data as $program)
                {
                    $guarantee = '';
                    if($program->guarantee == 1)
                    $guarantee = '<span>'.trans("main.Online").'</span>';
                    else
                    $guarantee = '';

                    $discount = '';
                    if($program->discount > 0)
                    $discount = '<span>%</span>';
                    else
                    $discount = '';
                    if(strlen($program->university->translate(app()->getLocale(), true)->name) > 50){
                        $phrase_array = explode(' ',$program->university->translate(app()->getLocale(), true)->name);
                        $sub_university = implode(' ',array_slice($phrase_array, 0, 3)).'...';
                    }else{
                        $phrase_array = explode(' ',$program->university->translate(app()->getLocale(), true)->name);
                        $sub_university = implode(' ',array_slice($phrase_array, 0, 3));
                    }
                    
                    $program_name = $program->translate(app()->getLocale(), true)->title;

                    if(strlen($program->translate(app()->getLocale(), true)->title) > 60){
                        $phrase_array2 = explode(' ',$program->translate(app()->getLocale(), true)->title);
                        $sub_program = implode(' ',array_slice($phrase_array2, 0, 4)).'...';
                    }else{
                        $phrase_array2 = explode(' ',$program->translate(app()->getLocale(), true)->title);
                        $sub_program = implode(' ',array_slice($phrase_array2, 0, 4));
                    }

                    $logo = UniversityImage::where('university_id',$program->university_id)
                    ->where('code','logo')->first();
                    $cover = UniversityImage::where('university_id',$program->university_id)
                    ->where('code','cover')->first();
                    $logo_img = asset('images/universities/'.$logo->image);
                    $cover_img = asset('images/universities/'.$cover->image);
                    $start = Start::where('program_id', $program->id)->first();
                    $deadline = Deadline::where('program_id', $program->id)->first();

                    if($program->duration == 1)
                    $duration = trans("main.$program->duration_type");
                    elseif($program->duration > 1)
                    $duration = trans("main.$program->duration_type"."s");

                    if($program->fees_type == "total"){
                        $fees = (int)(($program->fees- ($program->fees * $program->discount /100)) / $program->duration_year) ;
                    }elseif($program->fees_type == "year"){
                        $fees = (int)(($program->fees) - ($program->fees * $program->discount /100));
                    }
                        $output .= '
                    <div class="col-md-6 col-lg-4 col-sm-12 col-xs-12">
                        <div class="col-xs-12 grid-item">
                            <div class="grid-up">
                                <img src="'.$cover_img.'">
                                '.$guarantee.'  '.$discount.'
                                <!--<a href="'.route('university' , ['id'=>$program->university_id ,'slug' => $program->university->translate(app()->getLocale(), true)->slug]).'" class="icon-32favoriteHeart"></a>-->
                                <div class="grid-logo-main">
                                    <div class="grid-img-fram"> <img src="'.$logo_img.'"></div>
                                    <p>'.$sub_university.'</p>
                                </div>
                            </div>
                            <div class="grid-info">
                                <h4>'.Str::substr(strip_tags($program->country->translate(app()->getLocale(), true)->name),0,25).'</h4>
                                <!--<h6><span class="icon-33featured"></span>Featured</h6>-->
                                <div class="clearfix"></div>
                                <a href="'.route('program',  ['id'=>$program->id ,'slug' => $program->translate(app()->getLocale(), true)->slug]).'" class="grid-name-link">'.$program_name.'</a>
                                <h3>$'.$fees.'<span>/'.trans("main.year").'</span></h3>
                                <div class="clearfix"></div>
                                <div class="grid-event-info">
                                <p><span class="icon-25duration"></span>'.trans("main.Duration").' '.$program->duration.' '.$duration.'</p>
                                <p><span class="icon-71starts"></span>'.trans("main.Starts").' ('.Date::parse($start->date)->format('j M, yy').')</p>
                                <!--<p><span class="icon-74time"></span>'.trans("main.deadline").' ('.trans("main.$program->deadline").')</p>-->
                                </div>
                                <a  style="margin-top:-5 !important;" href="javascript:void(0);" class="compare-link compare-link-'.$program->id.'" data-program-id="'.$program->id.'" data-program-name="'.$program->translate(app()->getLocale(), true)->title.'">
                                    <span class="icon-16compare"></span>
                                    <h5  class="compare" data-compare-compare="'. __('lang.compare') .'" data-compare-added="'. __('lang.added') .'">'. __('lang.compare') .'</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                    ';
                    
                }
                $last_id += 12;
                if($counter > 12 && $newcount >= 12)
                $output .= '
                    <div class="col-xs-12 more-items-btn-main" id="load_more">
                        <a type="button" name="load_more_button" class="icon-49loadingMore" data-id="'.$last_id.'" id="load_more_button"> '.trans('main.load_more').' </a>
                    </div>
                    ';
            }
            else
            {
                $output .= '
                <div class="col-xs-12 more-items-btn-main" id="load_more">
                    <a type="button" name="load_more_button" class="icon-49loadingMore"> '.trans('main.no_data').' </a>
                </div>
                ';
            }
            echo $output;
        }
    }

    public function speak(StoreProgramSpeakRequest $request){
        $speak = Speaker::create(RequestHelper::mergeTransAttrs($request));
        if($speak)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.speak',[
                    'model' => class_basename(get_class(new $this->model))
                ])));
    }

    public function sitemap()
    {
        $now = Carbon::now();
        $programs = Program::where('status', 1)->get();
        $universities = University::where('status', 1)->get();
        return Response::view('sitemap',compact('now','programs','universities'))->header('Content-Type', 'application/xml');
    }

    public function report(StoreProgramReportRequest $request){
        //dd('error');
        $report = ProgramReport::create(RequestHelper::mergeTransAttrs($request));
        if($report)
        return json_encode($this->respondWithSuccess(trans('messages.'.$this->messageKeyName().'.speak',[
            'model' => class_basename(get_class(new $this->model))
        ])));
    }
}
