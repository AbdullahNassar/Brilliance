<?php

use Illuminate\Database\Seeder;
use App\Group as Group;
class GroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'en' => ['name' => 'Scholarships'],
				'ar' => ['name' => 'منح']
            ],
			[
                'en' => ['name' => 'Education'],
				'ar' => ['name' => 'تعليم']
            ],
			[
                'en' => ['name' => 'Success Stories'],
				'ar' => ['name' => 'قصص نجاح']
            ],
			[
                'en' => ['name' => 'Tips & Tricks'],
				'ar' => ['name' => 'نصائح']
            ],
			[
                'en' => ['name' => 'Other'],
				'ar' => ['name' => 'أخري']
            ]
        ];
        foreach ($categories as $item) {
            Group::create($item);
        }
    }

}
