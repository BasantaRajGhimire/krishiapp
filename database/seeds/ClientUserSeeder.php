<?php

use Illuminate\Database\Seeder;

class ClientUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data  = DB::table('client_users1')->get();
        foreach($data as $key => $d){
            foreach($d as $k => $s){
                if($k == 'phone_number'){                          
                    $rows[$key]['occupation'] = 'Employee';
                }else{             
                    $rows[$key][$k] = $s;
                }
            }
        }
        // $this->command->info(json_encode($rows));
        DB::table('client_users')->insert($rows);
    }
}
