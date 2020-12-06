<?php

use Illuminate\Database\Seeder;
use App\Category as Category;
use App\SubCategory as SubCategory;
class CategoriesSeeder extends Seeder
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
                'en' => ['name' => 'Category1'],
				'ar' => ['name' => 'Category1']
            ],
			[
                'en' => ['name' => 'Category2'],
				'ar' => ['name' => 'Category2']
            ]
        ];
        foreach ($categories as $item) {
            Category::create($item);
        }

        $sub_categories = [
            [
                'category_id' => '1',
                'en' => ['name' => 'SubCategory1'],
				'ar' => ['name' => 'SubCategory1']
            ],
			[
                'category_id' => '2',
                'en' => ['name' => 'SubCategory2'],
				'ar' => ['name' => 'SubCategory2']
            ]
        ];
        foreach ($sub_categories as $item) {
            SubCategory::create($item);
        }
    }

}
