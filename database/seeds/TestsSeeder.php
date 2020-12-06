<?php

use Illuminate\Database\Seeder;
use App\Test;
class TestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tests = [
            [
                'name' => 'TOEFL-IBT',
                'code' => 'TOEFL-IBT',
                'grade' => '120',
            ],
            [
                'name' => 'TOEFL-ITP',
                'code' => 'TOEFL-ITP',
                'grade' => '677',
            ],
            [
                'name' => 'TOEIC',
                'code' => 'TOEIC',
                'grade' => '990',
            ],
            [
                'name' => 'IELTS Academic',
                'code' => 'IELTS',
                'grade' => '9',
            ],
            [
                'name' => 'PTE Academic',
                'code' => 'PTE',
                'grade' => '90',
            ],
            [
                'name' => 'GMAT',
                'code' => 'GMAT',
                'grade' => '800',
            ],
            [
                'name' => 'GRE',
                'code' => 'GRE',
                'grade' => '340',
            ],
            [
                'name' => 'Old SAT I ',
                'code' => 'Old-SAT',
                'grade' => '2400',
            ],
            [
                'name' => 'NEW SAT I',
                'code' => 'NEW-SAT',
                'grade' => '1600',
            ],
            [
                'name' => 'SAT II',
                'code' => 'SAT-II',
                'grade' => '800',
            ],
            [
                'name' => 'ACT',
                'code' => 'ACT',
                'grade' => '36',
            ],
        ];
        foreach ($tests as $item) {
            $obj = Test::where('code', $item['code'])->first();
            if (!$obj) {
                Test::create($item);
            }
        }
    }

}
