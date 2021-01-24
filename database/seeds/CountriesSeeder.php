<?php

use Illuminate\Database\Seeder;
use App\Country;
class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            [
                'image' => 'EG.png',
                'flag' => 'EG.png',
                'en' => ['name' => 'Egypt'],
				'ar' => ['name' => 'مصر']
            ],
            [
                'image' => 'AE.png',
                'flag' => 'AE.png',
                'en' => ['name' => 'UAE'],
				'ar' => ['name' => 'الامارات']
            ],
            [
                'image' => 'US.png',
                'flag' => 'US.png',
                'en' => ['name' => 'USA'],
				'ar' => ['name' => 'امريكا']
            ],
            [
                'image' => 'CA.png',
                'flag' => 'CA.png',
                'en' => ['name' => 'Canada'],
				'ar' => ['name' => 'كندا']
            ],
        ];
        foreach ($countries as $item) {
            Country::create($item);
        }
    }

}
