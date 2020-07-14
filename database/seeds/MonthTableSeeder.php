<?php

use Illuminate\Database\Seeder;

class MonthTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $row[0] = [
            'name'=> 'January',
            'month_num' => '01',
        ];
        $row[1] = [
            'name'=> 'February',
            'month_num' => '02',
        ];
        $row[2] = [
            'name'=> 'March',
            'month_num' => '03',
        ];
        $row[3] = [
            'name'=> 'April',
            'month_num' => '04',
        ];
        $row[4] = [
            'name'=> 'May',
            'month_num' => '05',
        ];
        $row[5] = [
            'name'=> 'June',
            'month_num' => '06',
        ];
        $row[6] = [
            'name'=> 'July',
            'month_num' => '07',
        ];
        $row[7] = [
            'name'=> 'August',
            'month_num' => '08',
        ];
        $row[8] = [
            'name'=> 'September',
            'month_num' => '09',
        ];
        $row[9] = [
            'name'=> 'October',
            'month_num' => '10',
        ];
        $row[10] = [
            'name'=> 'November',
            'month_num' => '11',
        ];
        $row[11] = [
            'name'=> 'December',
            'month_num' => '12',
        ];
        DB::table('months')->insert($row);
        
    }
}
