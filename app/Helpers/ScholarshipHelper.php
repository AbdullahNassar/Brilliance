<?php

namespace App\Helpers;

use App\Scholarship;
use App\Deadline;
use App\Start;
use App\ScholarshipAdmission;
use App\ScholarshipBenefit;
use App\ScholarshipLanguageTest;
use App\ScholarshipTranslation;
use App\ScholarshipLanguage;
use App\Helpers\Request as RequestHelper;
use App\Http\Requests\Scholarship\StoreScholarshipRequest;
use Illuminate\Http\Request;

class ScholarshipHelper{
	
	public static function addScholarship(StoreScholarshipRequest $request)
	{
	    $duration_year = 0;
	    if($request->duration_type == 'day')
	    $duration_year = $request->duration / 365;
	    
	    if($request->duration_type == 'month')
	    $duration_year = $request->duration / 12;
	    
	    if($request->duration_type == 'week')
	    $duration_year = $request->duration / 52.143;
	    
	    if($request->duration_type == 'year')
	    $duration_year = $request->duration;
	    
        if($request->guarantee == '1'){
            $Scholarship = Scholarship::create(array_merge(['guarantee' => '1','duration_year' => $duration_year,'status' => '1'], RequestHelper::mergeTransAttrs($request)));
        }else{                
            $Scholarship = Scholarship::create(array_merge(['guarantee' => '0','duration_year' => $duration_year,'status' => '1'], RequestHelper::mergeTransAttrs($request)));
        }
        if($Scholarship){
            $languages = $request->languages;
            foreach($languages as $language){
                ScholarshipLanguage::create([
                    'Scholarship_id' => $Scholarship->id,
                    'language_id' => $language,
                ]);
            }
            if($request->deadline == 'custom'){
                $deadlines = $request->input("deadlines");
                if(!empty($deadlines)){
                    foreach($deadlines as $deadline){
                        if($deadline != null)
                        Deadline::create([
                            'Scholarship_id' => $Scholarship->id,
                            'date' => $deadline,
                        ]);
                    }
                }
            }
            $starts = $request->input("starts");
            if(!empty($starts)){
                foreach($starts as $start){
                    if($start != null)
                    Start::create([
                        'Scholarship_id' => $Scholarship->id,
                        'date' => $start,
                    ]);
                }
            }
            $admissions = $request->input("admissions");
            if(!empty($admissions)){
                foreach($admissions as $key=>$admission)
                {
                    if($admission['score'] != null){
                        ScholarshipAdmission::create([
                            'Scholarship_id' => $Scholarship->id,
                            'name_en' => $admission['name_en'],
                            'name_ar' => $admission['name_ar'],
                            'score' => $admission['score'],
                            'required_score' => $admission['required_score'],
                            'details_en' => $admission['details_en'],
                            'details_ar' => $admission['details_ar'],
                        ]);
                    }
                }
            }
            $language_tests = $request->input("language_tests");
            if(!empty($language_tests)){
                $Scholarship->update(['test'=> 1]);
                foreach($language_tests as $key=>$language_test){
                    if($language_test['score'] != null){
                        ScholarshipLanguageTest::create([
                            'Scholarship_id' => $Scholarship->id,
                            'test_id' => $language_test['test_id'],
                            'score' => $language_test['score'],
                            'details_en' => $language_test['details_en'],
                            'details_ar' => $language_test['details_ar'],
                        ]);
                    }
                }
            }else{
                $Scholarship->update(['test'=> 0]);
            }
            

            $benefits = $request->input("benefits");
            if(!empty($benefits)){
                foreach($benefits as $key=>$benefit){
                    if($benefit['benefit'] != null){
                        ScholarshipBenefit::create([
                            'Scholarship_id' => $Scholarship->id,
                            'benefit' => $benefit['benefit'],
                            'details_en' => $benefit['details_en'],
                            'details_ar' => $benefit['details_ar'],
                        ]);
                    }
                }
            }
            return ['data' => $Scholarship];
        }       
    }
    
    public static function draftScholarship(Request $request)
	{
	    $duration_year = 0;
	    if($request->duration_type == 'day')
	    $duration_year = $request->duration / 365;
	    
	    if($request->duration_type == 'month')
	    $duration_year = $request->duration / 12;
	    
	    if($request->duration_type == 'week')
	    $duration_year = $request->duration / 52.143;
	    
	    if($request->duration_type == 'year')
	    $duration_year = $request->duration;
	    
        $Scholarship = new Scholarship;
        $Scholarship->status = 0;
        $Scholarship->university_id = $request->university_id;
        $Scholarship->country_id = $request->country_id;
        $Scholarship->sub_category_id = $request->sub_category_id;
        $Scholarship->degree = $request->degree;
        $Scholarship->link = $request->link;
        $Scholarship->deadline = $request->deadline;
        $Scholarship->test = $request->test;
        $Scholarship->location = $request->location;
        $Scholarship->duration = $request->duration;
        $Scholarship->duration_type = $request->duration_type;
        $Scholarship->fees = $request->fees;
        $Scholarship->fees_type = $request->fees_type;
        $Scholarship->discount = $request->discount;
        $Scholarship->application_fees = $request->application_fees;
        $Scholarship->study_type = $request->study_type;
        $Scholarship->delivery_mode = $request->delivery_mode;
        $Scholarship->keywords = $request->keywords;
        $Scholarship->user_id = $request->user_id;
        $Scholarship->duration_year = $duration_year;
        if($request->guarantee == '1'){
            $Scholarship->guarantee = 1;
        }else{                
            $Scholarship->guarantee = 0;
        }
        
        if($Scholarship->save()){
            $attrs = [
                [
                    'Scholarship_id' => $Scholarship->id,
                    'title' => $request->translatedAttrs['en']['title'],
                    'slug' => $request->translatedAttrs['en']['slug'],
                    'about' => $request->translatedAttrs['en']['about'],
                    'courses' => $request->translatedAttrs['en']['courses'],
                    'locale' => 'en',
                ],
                [
                    'Scholarship_id' => $Scholarship->id,
                    'title' => $request->translatedAttrs['ar']['title'],
                    'slug' => $request->translatedAttrs['ar']['slug'],
                    'about' => $request->translatedAttrs['ar']['about'],
                    'courses' => $request->translatedAttrs['ar']['courses'],
                    'locale' => 'ar',
                ]
            ];
            foreach ($attrs as $item) {
                ScholarshipTranslation::create($item);
            }
            $languages = $request->languages;
            if($languages){
                foreach($languages as $language){
                    ScholarshipLanguage::create([
                        'Scholarship_id' => $Scholarship->id,
                        'language_id' => $language,
                    ]);
                }
            }
            if($request->deadline == 'custom'){
                $deadlines = $request->input("deadlines");
                if(!empty($deadlines)){
                    foreach($deadlines as $deadline){
                        if($deadline != null)
                        Deadline::create([
                            'Scholarship_id' => $Scholarship->id,
                            'date' => $deadline,
                        ]);
                    }
                }
            }
            $starts = $request->input("starts");
            if(!empty($starts)){
                foreach($starts as $start){
                    if($start != null)
                    Start::create([
                        'Scholarship_id' => $Scholarship->id,
                        'date' => $start,
                    ]);
                }
            }

            $admissions = $request->input("admissions");
            if(!empty($admissions)){
                foreach($admissions as $key=>$admission)
                {
                    if($admission['score'] != null){
                        ScholarshipAdmission::create([
                            'Scholarship_id' => $Scholarship->id,
                            'name_en' => $admission['name_en'],
                            'name_ar' => $admission['name_ar'],
                            'score' => $admission['score'],
                            'required_score' => $admission['required_score'],
                            'details_en' => $admission['details_en'],
                            'details_ar' => $admission['details_ar'],
                        ]);
                    }
                }
            }

            $language_tests = $request->input("language_tests");
            if(!empty($language_tests)){
                $Scholarship->update(['test'=> 1]);
                foreach($language_tests as $key=>$language_test){
                    if($language_test['score'] != null){
                        ScholarshipLanguageTest::create([
                            'Scholarship_id' => $Scholarship->id,
                            'test_id' => $language_test['test_id'],
                            'score' => $language_test['score'],
                            'details_en' => $language_test['details_en'],
                            'details_ar' => $language_test['details_ar'],
                        ]);
                    }
                }
            }else{
                $Scholarship->update(['test'=> 0]);
            }
            
            $benefits = $request->input("benefits");
            if(!empty($benefits)){
                    foreach($benefits as $key=>$benefit){
                        if($benefit['benefit'] != null){
                            ScholarshipBenefit::create([
                                'Scholarship_id' => $Scholarship->id,
                                'benefit' => $benefit['benefit'],
                                'details_en' => $benefit['details_en'],
                                'details_ar' => $benefit['details_ar'],
                            ]);
                        }
                    }
            }
            return ['data' => $Scholarship];
        }     
	}

    public static function editScholarship($request,$id)
	{		
		if($Scholarship = Scholarship::find($id)) {
		    $duration_year = 0;
            if($request->duration_type == 'day')
    	    $duration_year = $request->duration / 365;
    	    
    	    if($request->duration_type == 'month')
    	    $duration_year = $request->duration / 12;
    	    
    	    if($request->duration_type == 'week')
    	    $duration_year = $request->duration / 52.143;
    	    
    	    if($request->duration_type == 'year')
    	    $duration_year = $request->duration;
	    
            if($request->guarantee == '1'){
                $Scholarship->update(array_merge(['user_id' => $Scholarship->user_id,'guarantee' => '1','duration_year' => $duration_year,'status' => '1'], RequestHelper::mergeTransAttrs($request)));
            }else{
                $Scholarship->update(array_merge(['user_id' => $Scholarship->user_id,'guarantee' => '0','duration_year' => $duration_year,'status' => '1'], RequestHelper::mergeTransAttrs($request)));
            }
            if($Scholarship){
                ScholarshipLanguage::where('Scholarship_id',$id)->delete();
                $languages = $request->languages;
                if(!empty($languages)){
                    foreach($languages as $language){
                        ScholarshipLanguage::create([
                            'Scholarship_id' => $Scholarship->id,
                            'language_id' => $language,
                        ]);
                    }
                }
                
                $deadlines = $request->input("deadlines");
                if(!empty($deadlines)){
                    Deadline::where('Scholarship_id',$id)->delete();
                    if($request->deadline == 'custom'){
                        foreach($deadlines as $deadline){
                            if($deadline != null)
                            Deadline::create([
                                'Scholarship_id' => $Scholarship->id,
                                'date' => $deadline,
                            ]);
                        }
                    }
                }
                $starts = $request->input("starts");
                if(!empty($starts)){
                Start::where('Scholarship_id',$id)->delete();
                foreach($starts as $start){
                    if($start != null)
                    Start::create([
                        'Scholarship_id' => $Scholarship->id,
                        'date' => $start,
                    ]);
                }
                }
                $admissions = $request->input("admissions");
                ScholarshipAdmission::where('Scholarship_id',$id)->delete();
                if(!empty($admissions)){
                    foreach($admissions as $key=>$admission)
                    {
                        if($admission['score'] != null){
                            ScholarshipAdmission::create([
                                'Scholarship_id' => $Scholarship->id,
                                'name_en' => $admission['name_en'],
                                'name_ar' => $admission['name_ar'],
                                'score' => $admission['score'],
                                'required_score' => $admission['required_score'],
                                'details_en' => $admission['details_en'],
                                'details_ar' => $admission['details_ar'],
                            ]);
                        }
                    }
                }
                
    
                $language_tests = $request->input("language_tests");
                ScholarshipLanguageTest::where('Scholarship_id',$id)->delete();
                if(!empty($language_tests)){
                    foreach($language_tests as $key=>$language_test){
                        if($language_test['score'] != null){
                            ScholarshipLanguageTest::create([
                                'Scholarship_id' => $Scholarship->id,
                                'test_id' => $language_test['test_id'],
                                'score' => $language_test['score'],
                                'details_en' => $language_test['details_en'],
                                'details_ar' => $language_test['details_ar'],
                            ]);
                        }
                    }
                }else{
                    $Scholarship->update(['test'=> 0]);
                }
                
    
                $benefits = $request->input("benefits");
                ScholarshipBenefit::where('Scholarship_id',$id)->delete();
                if(!empty($benefits)){
                    foreach($benefits as $key=>$benefit){
                        if($benefit['benefit'] != null){
                            ScholarshipBenefit::create([
                                'Scholarship_id' => $Scholarship->id,
                                'benefit' => $benefit['benefit'],
                                'details_en' => $benefit['details_en'],
                                'details_ar' => $benefit['details_ar'],
                            ]);
                        }
                    }
                }
                return ['data' => $Scholarship];
            }
		}
    }
    
    public static function editDraft($request,$id)
	{		
		if($Scholarship = Scholarship::find($id)) {
		    $duration_year = 0;
            if($request->duration_type == 'day')
    	    $duration_year = $request->duration / 365;
    	    
    	    if($request->duration_type == 'month')
    	    $duration_year = $request->duration / 12;
    	    
    	    if($request->duration_type == 'week')
    	    $duration_year = $request->duration / 52.143;
    	    
    	    if($request->duration_type == 'year')
    	    $duration_year = $request->duration;
    	    
            $Scholarship->status = 0;
            $Scholarship->university_id = $request->university_id;
            $Scholarship->country_id = $request->country_id;
            $Scholarship->sub_category_id = $request->sub_category_id;
            $Scholarship->degree = $request->degree;
            $Scholarship->link = $request->link;
            $Scholarship->deadline = $request->deadline;
            $Scholarship->test = $request->test;
            $Scholarship->location = $request->location;
            $Scholarship->duration = $request->duration;
            $Scholarship->duration_type = $request->duration_type;
            $Scholarship->fees = $request->fees;
            $Scholarship->fees_type = $request->fees_type;
            $Scholarship->discount = $request->discount;
            $Scholarship->application_fees = $request->application_fees;
            $Scholarship->study_type = $request->study_type;
            $Scholarship->delivery_mode = $request->delivery_mode;
            $Scholarship->keywords = $request->keywords;
            $Scholarship->user_id = $Scholarship->user_id;
            $Scholarship->duration_year = $duration_year;
            if($request->guarantee == '1'){
                $Scholarship->guarantee = 1;
            }else{                
                $Scholarship->guarantee = 0;
            }
            
            if($Scholarship->save()){
                ScholarshipTranslation::where('Scholarship_id',$id)->where('locale','en')->update([
                    'Scholarship_id' => $Scholarship->id,
                    'title' => $request->translatedAttrs['en']['title'],
                    'slug' => $request->translatedAttrs['en']['slug'],
                    'about' => $request->translatedAttrs['en']['about'],
                    'courses' => $request->translatedAttrs['en']['courses'],
                    'locale' => 'en',
                ]);
                ScholarshipTranslation::where('Scholarship_id',$id)->where('locale','ar')->update([
                    'Scholarship_id' => $Scholarship->id,
                    'title' => $request->translatedAttrs['ar']['title'],
                    'slug' => $request->translatedAttrs['ar']['slug'],
                    'about' => $request->translatedAttrs['ar']['about'],
                    'courses' => $request->translatedAttrs['ar']['courses'],
                    'locale' => 'ar',
                ]);
                
                ScholarshipLanguage::where('Scholarship_id',$id)->delete();
                $languages = $request->languages;
                if(!empty($languages)){
                    foreach($languages as $language){
                        ScholarshipLanguage::create([
                            'Scholarship_id' => $Scholarship->id,
                            'language_id' => $language,
                        ]);
                    }
                }
                
                $deadlines = $request->input("deadlines");
                if(!empty($deadlines)){
                Deadline::where('Scholarship_id',$id)->delete();
                if($request->deadline == 'custom'){
                    foreach($deadlines as $deadline){
                        if($deadline != null)
                        Deadline::create([
                            'Scholarship_id' => $Scholarship->id,
                            'date' => $deadline,
                        ]);
                    }
                }
                }
                $starts = $request->input("starts");
                if(!empty($starts)){
                Start::where('Scholarship_id',$id)->delete();
                foreach($starts as $start){
                    if($start != null)
                    Start::create([
                        'Scholarship_id' => $Scholarship->id,
                        'date' => $start,
                    ]);
                }
                }
                $admissions = $request->input("admissions");
                ScholarshipAdmission::where('Scholarship_id',$id)->delete();
                if(!empty($admissions)){
                    foreach($admissions as $key=>$admission)
                    {
                        if($admission['score'] != null){
                            ScholarshipAdmission::create([
                                'Scholarship_id' => $Scholarship->id,
                                'name_en' => $admission['name_en'],
                                'name_ar' => $admission['name_ar'],
                                'score' => $admission['score'],
                                'required_score' => $admission['required_score'],
                                'details_en' => $admission['details_en'],
                                'details_ar' => $admission['details_ar'],
                            ]);
                        }
                    }
                }
                
    
                $language_tests = $request->input("language_tests");
                ScholarshipLanguageTest::where('Scholarship_id',$id)->delete();
                if(!empty($language_tests)){
                    foreach($language_tests as $key=>$language_test){
                        if($language_test['score'] != null){
                            ScholarshipLanguageTest::create([
                                'Scholarship_id' => $Scholarship->id,
                                'test_id' => $language_test['test_id'],
                                'score' => $language_test['score'],
                                'details_en' => $language_test['details_en'],
                                'details_ar' => $language_test['details_ar'],
                            ]);
                        }
                    }
                }
                
    
                $benefits = $request->input("benefits");
                ScholarshipBenefit::where('Scholarship_id',$id)->delete();
                if(!empty($benefits)){
                    foreach($benefits as $key=>$benefit){
                        if($benefit['benefit'] != null){
                            ScholarshipBenefit::create([
                                'Scholarship_id' => $Scholarship->id,
                                'benefit' => $benefit['benefit'],
                                'details_en' => $benefit['details_en'],
                                'details_ar' => $benefit['details_ar'],
                            ]);
                        }
                    }
                }
                
                return ['data' => $Scholarship];
            }
		}
	}
}