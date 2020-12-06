<?php

namespace App\Helpers;

use App\Country;
use App\Helpers\Uploader;
use Illuminate\Support\Str;
use App\Helpers\Request as RequestHelper;
use Intervention\Image\ImageManagerStatic as Image;

class CountryHelper{
	
	public static function addCountry($request)
	{
        $avatar = $request->file('image');
        $file = $request->file('flag');
        $path = public_path('images/countries');
        $country = Country::create(RequestHelper::mergeTransAttrs($request));
        if($country){
            if($file != null && $avatar != null){
                $extension = $avatar->getClientOriginalExtension();
                $oldFileName = pathinfo($avatar->getClientOriginalName(), PATHINFO_FILENAME);
                $fileName = $oldFileName .'-'. Str::random(10).'.'.$extension;
                Image::make($avatar->getRealPath())->crop(1200, 453, 0, 0)->save( public_path('images/countries/' . $fileName ) );                
                $flag = Uploader::upload($file,$path);
                Country::where('id',$country->id)->update([
                    'image' => $fileName,
                    'flag' => $flag,
                ]);
                return ['data' => $country];
            }
        }       
	}

    public static function editCountry($request,$id)
	{		
		if($country = Country::find($id)) {
            $avatar = $request->file('image');
            $file = $request->file('flag');
            $path = public_path('images/countries');
            $country->update(RequestHelper::mergeTransAttrs($request));
            if($country){
                if($request->hasFile('image')){
                    $extension = $avatar->getClientOriginalExtension();
                    $oldFileName = pathinfo($avatar->getClientOriginalName(), PATHINFO_FILENAME);
                    $fileName = $oldFileName .'-'. Str::random(10).'.'.$extension;
                    //dd($fileName);
                    Image::make($avatar->getRealPath())->crop(1200, 453, 0, 0)->save( public_path('images/countries/' . $fileName ) );
                    Country::where('id',$country->id)->update([
                        'image' => $fileName,
                    ]);
                }
                if($request->hasFile('flag')){
                    $flag = Uploader::upload($file,$path);
                    Country::where('id',$country->id)->update([
                        'flag' => $flag,
                    ]);
                }
                return ['data' => $country];
            }       
		}
	}
}