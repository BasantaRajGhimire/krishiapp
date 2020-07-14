<?php

use Illuminate\Database\Seeder;

class VendorCategory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        $mrows = DB::table('vendor_type')->get();
        $srows = DB::table('service_types')->get();
        $mdata = $this::arrayData($mrows, 'M','name');
        $sdata = $this::arrayData($srows, 'S','service_type_name');
        // $this->command->info(json_encode($data));
        DB::table('vendor_category')->insert($mdata);
        DB::table('vendor_category')->insert($sdata);
        
    }
    public function arrayData($rows,$type, $name){
        foreach($rows as $r){
            $row[] = [
                'id' => $r->id,
                'name' => $r->$name,
                'vendor_type' => $type,
            ];
        }
        return $row;
    }
}
