<?php

namespace App\Helpers;

use App\University;
use App\UniversityTranslation;
use App\UniversityImage;
use Illuminate\Support\Str;
use App\Helpers\Request as RequestHelper;
use Intervention\Image\ImageManagerStatic as Image;

class UniversityHelper{
	
	public static function addUniversity($request)
	{
        $path = public_path('images/universities');
        $logo = $request->file('logo');
        $cover = $request->file('cover');
        $image = $request->file('image');
        $university = University::create(array_merge(['status' => '1'], RequestHelper::mergeTransAttrs($request)));
        if($university){
            if($logo){
                $logoExtension = $logo->getClientOriginalExtension();
                $oldLogoNameFileName = pathinfo($logo->getClientOriginalName(), PATHINFO_FILENAME);
                $logoName = $oldLogoNameFileName .'-'. Str::random(10).'.'.$logoExtension;
                Image::make($logo->getRealPath())->crop(80, 80, 0, 0)->save( public_path('images/universities/' . $logoName ) );
                UniversityImage::create([
                    'code' => 'logo',
                    'image' => $logoName,
                    'university_id' => $university->id,
                ]);
            }
            if($cover){
                $coverExtension = $cover->getClientOriginalExtension();
                $oldCoverNameFileName = pathinfo($cover->getClientOriginalName(), PATHINFO_FILENAME);
                $coverName = $oldCoverNameFileName .'-'. Str::random(10).'.'.$coverExtension;
                Image::make($cover->getRealPath())->crop(1200, 453, 0, 0)->save( public_path('images/universities/' . $coverName ) );
                UniversityImage::create([
                    'code' => 'cover',
                    'image' => $coverName,
                    'university_id' => $university->id,
                ]);
            }
            if($image){
                $imageExtension = $image->getClientOriginalExtension();
                $oldImageNameFileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $imageName = $oldImageNameFileName .'-'. Str::random(10).'.'.$imageExtension;
                Image::make($image->getRealPath())->crop(300, 275, 0, 0)->save( public_path('images/universities/' . $imageName ) );
                UniversityImage::create([
                    'code' => 'image',
                    'image' => $imageName,
                    'university_id' => $university->id,
                ]);
            }
            
            return ['data' => $university];
        }       
	}

    public static function draftUniversity($request)
	{
        $path = public_path('images/universities');
        $logo = $request->file('logo');
        $cover = $request->file('cover');
        $image = $request->file('image');
        $university = new University;
        $university->status = 0;
        $university->longitude = $request->longitude;
        $university->latitude = $request->latitude;
        $university->number_of_students = $request->number_of_students;
        $university->country_id = $request->country_id;
        $university->website = $request->website;
        if($university->save()){
            $attrs = [
                [
                    'university_id' => $university->id,
                    'name' => $request->translatedAttrs['en']['name'],
                    'slug' => $request->translatedAttrs['en']['slug'],
                    'description' => $request->translatedAttrs['en']['description'],
                    'reasons' => $request->translatedAttrs['en']['reasons'],
                    'overview' => $request->translatedAttrs['en']['overview'],
                    'history' => $request->translatedAttrs['en']['history'],
                    'education' => $request->translatedAttrs['en']['education'],
                    'research' => $request->translatedAttrs['en']['research'],
                    'career' => $request->translatedAttrs['en']['career'],
                    'student_services' => $request->translatedAttrs['en']['student_services'],
                    'housing_services' => $request->translatedAttrs['en']['housing_services'],
                    'library_services' => $request->translatedAttrs['en']['library_services'],
                    'ict_services' => $request->translatedAttrs['en']['ict_services'],
                    'medical_services' => $request->translatedAttrs['en']['medical_services'],
                    'campus_life' => $request->translatedAttrs['en']['campus_life'],
                    'sports_facilities' => $request->translatedAttrs['en']['sports_facilities'],
                    'student_clubs' => $request->translatedAttrs['en']['student_clubs'],
                    'accrediations' => $request->translatedAttrs['en']['accrediations'],
                    'locale' => 'en',
                ],
                [
                    'university_id' => $university->id,
                    'name' => $request->translatedAttrs['ar']['name'],
                    'slug' => $request->translatedAttrs['ar']['slug'],
                    'description' => $request->translatedAttrs['ar']['description'],
                    'reasons' => $request->translatedAttrs['ar']['reasons'],
                    'overview' => $request->translatedAttrs['ar']['overview'],
                    'history' => $request->translatedAttrs['ar']['history'],
                    'education' => $request->translatedAttrs['ar']['education'],
                    'research' => $request->translatedAttrs['ar']['research'],
                    'career' => $request->translatedAttrs['ar']['career'],
                    'student_services' => $request->translatedAttrs['ar']['student_services'],
                    'housing_services' => $request->translatedAttrs['ar']['housing_services'],
                    'library_services' => $request->translatedAttrs['ar']['library_services'],
                    'ict_services' => $request->translatedAttrs['ar']['ict_services'],
                    'medical_services' => $request->translatedAttrs['ar']['medical_services'],
                    'campus_life' => $request->translatedAttrs['ar']['campus_life'],
                    'sports_facilities' => $request->translatedAttrs['ar']['sports_facilities'],
                    'student_clubs' => $request->translatedAttrs['ar']['student_clubs'],
                    'accrediations' => $request->translatedAttrs['ar']['accrediations'],
                    'locale' => 'ar',
                ]
            ];
            foreach ($attrs as $item) {
                UniversityTranslation::create($item);
            }
            if($logo){
                $logoExtension = $logo->getClientOriginalExtension();
                $oldLogoNameFileName = pathinfo($logo->getClientOriginalName(), PATHINFO_FILENAME);
                $logoName = $oldLogoNameFileName .'-'. Str::random(10).'.'.$logoExtension;
                Image::make($logo->getRealPath())->crop(80, 80, 0, 0)->save( public_path('images/universities/' . $logoName ) );
                UniversityImage::create([
                    'code' => 'logo',
                    'image' => $logoName,
                    'university_id' => $university->id,
                ]);
            }
            if($cover){
                $coverExtension = $cover->getClientOriginalExtension();
                $oldCoverNameFileName = pathinfo($cover->getClientOriginalName(), PATHINFO_FILENAME);
                $coverName = $oldCoverNameFileName .'-'. Str::random(10).'.'.$coverExtension;
                Image::make($cover->getRealPath())->crop(1200, 453, 0, 0)->save( public_path('images/universities/' . $coverName ) );
                UniversityImage::create([
                    'code' => 'cover',
                    'image' => $coverName,
                    'university_id' => $university->id,
                ]);
            }
            if($image){
                $imageExtension = $image->getClientOriginalExtension();
                $oldImageNameFileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $imageName = $oldImageNameFileName .'-'. Str::random(10).'.'.$imageExtension;
                Image::make($image->getRealPath())->crop(300, 275, 0, 0)->save( public_path('images/universities/' . $imageName ) );
                UniversityImage::create([
                    'code' => 'image',
                    'image' => $imageName,
                    'university_id' => $university->id,
                ]);
            }
            return ['data' => $university];
        }       
	}

    public static function editUniversity($request,$id)
	{		
		if($university = University::find($id)) {
            $logo = $request->file('logo');
            $cover = $request->file('cover');
            $image = $request->file('image');
            $university->update(array_merge(['status' => '1'], RequestHelper::mergeTransAttrs($request)));
            if($university){
                if($logo != null) {
                    $logoExtension = $logo->getClientOriginalExtension();
                    $oldLogoNameFileName = pathinfo($logo->getClientOriginalName(), PATHINFO_FILENAME);
                    $logoName = $oldLogoNameFileName .'-'. Str::random(10).'.'.$logoExtension;
                    Image::make($logo->getRealPath())->crop(80, 80, 0, 0)->save( public_path('images/universities/' . $logoName ) );
                    UniversityImage::where('university_id',$id)->where('code','logo')->delete();
                    UniversityImage::create([
                        'code' => 'logo',
                        'image' => $logoName,
                        'university_id' => $university->id,
                    ]);
                }
                if($cover!= null) {
                    $coverExtension = $cover->getClientOriginalExtension();
                    $oldCoverNameFileName = pathinfo($cover->getClientOriginalName(), PATHINFO_FILENAME);
                    $coverName = $oldCoverNameFileName .'-'. Str::random(10).'.'.$coverExtension;
                    Image::make($cover->getRealPath())->crop(1200, 453, 0, 0)->save( public_path('images/universities/' . $coverName ) );
                    UniversityImage::where('university_id',$id)->where('code','cover')->delete();
                    UniversityImage::create([
                        'code' => 'cover',
                        'image' => $coverName,
                        'university_id' => $university->id,
                    ]);
                }
                if($image!= null){
                    $imageExtension = $image->getClientOriginalExtension();
                    $oldImageNameFileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                    $imageName = $oldImageNameFileName .'-'. Str::random(10).'.'.$imageExtension;
                    Image::make($image->getRealPath())->crop(300, 275, 0, 0)->save( public_path('images/universities/' . $imageName ) );
                    UniversityImage::where('university_id',$id)->where('code','image')->delete();
                    UniversityImage::create([
                        'code' => 'image',
                        'image' => $imageName,
                        'university_id' => $university->id,
                    ]);
                }
                return ['data' => $university];
            }       
		}
    }
    
    public static function editDraft($request,$id)
	{		
		if($university = University::find($id)) {
            $logo = $request->file('logo');
            $cover = $request->file('cover');
            $image = $request->file('image');
            $university->status = 0;
            $university->longitude = $request->longitude;
            $university->latitude = $request->latitude;
            $university->number_of_students = $request->number_of_students;
            $university->country_id = $request->country_id;
            $university->website = $request->website;
            if($university->save()){
                UniversityTranslation::where('university_id',$id)->where('locale','en')->update([
                    'university_id' => $university->id,
                    'name' => $request->translatedAttrs['en']['name'],
                    'slug' => $request->translatedAttrs['en']['slug'],
                    'description' => $request->translatedAttrs['en']['description'],
                    'reasons' => $request->translatedAttrs['en']['reasons'],
                    'overview' => $request->translatedAttrs['en']['overview'],
                    'history' => $request->translatedAttrs['en']['history'],
                    'education' => $request->translatedAttrs['en']['education'],
                    'research' => $request->translatedAttrs['en']['research'],
                    'career' => $request->translatedAttrs['en']['career'],
                    'student_services' => $request->translatedAttrs['en']['student_services'],
                    'housing_services' => $request->translatedAttrs['en']['housing_services'],
                    'library_services' => $request->translatedAttrs['en']['library_services'],
                    'ict_services' => $request->translatedAttrs['en']['ict_services'],
                    'medical_services' => $request->translatedAttrs['en']['medical_services'],
                    'campus_life' => $request->translatedAttrs['en']['campus_life'],
                    'sports_facilities' => $request->translatedAttrs['en']['sports_facilities'],
                    'student_clubs' => $request->translatedAttrs['en']['student_clubs'],
                    'accrediations' => $request->translatedAttrs['en']['accrediations'],
                    'locale' => 'en',
                ]);
                UniversityTranslation::where('university_id',$id)->where('locale','ar')->update([
                    'university_id' => $university->id,
                    'name' => $request->translatedAttrs['ar']['name'],
                    'slug' => $request->translatedAttrs['ar']['slug'],
                    'description' => $request->translatedAttrs['ar']['description'],
                    'reasons' => $request->translatedAttrs['ar']['reasons'],
                    'overview' => $request->translatedAttrs['ar']['overview'],
                    'history' => $request->translatedAttrs['ar']['history'],
                    'education' => $request->translatedAttrs['ar']['education'],
                    'research' => $request->translatedAttrs['ar']['research'],
                    'career' => $request->translatedAttrs['ar']['career'],
                    'student_services' => $request->translatedAttrs['ar']['student_services'],
                    'housing_services' => $request->translatedAttrs['ar']['housing_services'],
                    'library_services' => $request->translatedAttrs['ar']['library_services'],
                    'ict_services' => $request->translatedAttrs['ar']['ict_services'],
                    'medical_services' => $request->translatedAttrs['ar']['medical_services'],
                    'campus_life' => $request->translatedAttrs['ar']['campus_life'],
                    'sports_facilities' => $request->translatedAttrs['ar']['sports_facilities'],
                    'student_clubs' => $request->translatedAttrs['ar']['student_clubs'],
                    'accrediations' => $request->translatedAttrs['ar']['accrediations'],
                    'locale' => 'ar',
                ]);
                if($logo != null) {
                    $logoExtension = $logo->getClientOriginalExtension();
                    $oldLogoNameFileName = pathinfo($logo->getClientOriginalName(), PATHINFO_FILENAME);
                    $logoName = $oldLogoNameFileName .'-'. Str::random(10).'.'.$logoExtension;
                    Image::make($logo->getRealPath())->crop(80, 80, 0, 0)->save( public_path('images/universities/' . $logoName ) );
                    UniversityImage::where('university_id',$id)->where('code','logo')->delete();
                    UniversityImage::create([
                        'code' => 'logo',
                        'image' => $logoName,
                        'university_id' => $university->id,
                    ]);
                }
                if($cover!= null) {
                    $coverExtension = $cover->getClientOriginalExtension();
                    $oldCoverNameFileName = pathinfo($cover->getClientOriginalName(), PATHINFO_FILENAME);
                    $coverName = $oldCoverNameFileName .'-'. Str::random(10).'.'.$coverExtension;
                    Image::make($cover->getRealPath())->crop(1200, 453, 0, 0)->save( public_path('images/universities/' . $coverName ) );
                    UniversityImage::where('university_id',$id)->where('code','cover')->delete();
                    UniversityImage::create([
                        'code' => 'cover',
                        'image' => $coverName,
                        'university_id' => $university->id,
                    ]);
                }
                if($image!= null){
                    $imageExtension = $image->getClientOriginalExtension();
                    $oldImageNameFileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                    $imageName = $oldImageNameFileName .'-'. Str::random(10).'.'.$imageExtension;
                    Image::make($image->getRealPath())->crop(300, 275, 0, 0)->save( public_path('images/universities/' . $imageName ) );
                    UniversityImage::where('university_id',$id)->where('code','image')->delete();
                    UniversityImage::create([
                        'code' => 'image',
                        'image' => $imageName,
                        'university_id' => $university->id,
                    ]);
                }
                return ['data' => $university];
            }       
		}
	}

	public static function duplicateuniversity($id){
        $university = University::find($id);
        if($university){
            $new_university = $university->replicate();
            if($new_university->save()){
                $translations = $university->translations()->get();
                foreach($translations as $translation){
                    $new_university->translations()->create($translation->toArray());
                }
                $images = $university->images()->get();
                foreach($images as $image){
                    $new_university->images()->create($image->toArray());
                }
            }
        }
        return ['data' => $university];
    }

}