<?php

use Illuminate\Database\Seeder;
use App\Language as Language;
class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = [
            [
                'code' => 'en',
                'en' => ['name' => 'English'],
				'ar' => ['name' => 'انجليزى']
            ],
			[
                'code' => 'ge',
                'en' => ['name' => 'German'],
				'ar' => ['name' => 'الألمانية']
            ],
			[
                'code' => 'sp',
                'en' => ['name' => 'Spanish'],
				'ar' => ['name' => 'الاسبانية']
            ],
			[
                'code' => 'fr',
                'en' => ['name' => 'French'],
				'ar' => ['name' => 'الفرنسية']
            ],
			[
                'code' => 'ch',
                'en' => ['name' => 'Chinese'],
				'ar' => ['name' => 'الصينية']
            ],
			[
                'code' => 'ru',
                'en' => ['name' => 'Russian'],
				'ar' => ['name' => 'الروسية']
            ]
        ];
        foreach ($languages as $item) {
            $obj = Language::where('code', $item['code'])->first();
            if (!$obj) {
                Language::create($item);
            }
        }
    }

}
