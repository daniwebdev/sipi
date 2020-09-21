<?php
namespace Database\Seeds;

use App\RegionalCity;
use App\RegionalDistrict;
use App\RegionalProvince;
use App\RegionalVillage;
use Illuminate\Database\Seeder;

class RegionalProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = __DIR__.'/sources/provinces.json';

        $fetch = file_get_contents($path);

        $array = json_decode($fetch);

        foreach($array as $data) {
            RegionalProvince::create([
                "id" => $data->id,
                "name" => $data->name,
                "latitude" => $data->latitude,
                "longitude" => $data->longitude,
            ]);
        }

        //---------------------------------
        
        $path = __DIR__.'/sources/regencies.json';

        $fetch = file_get_contents($path);

        $array = json_decode($fetch);
        foreach($array as $data) {
            RegionalCity::create([
                "id" => $data->id,
                "province_id" => $data->province_id,
                "name" => $data->name,
                "latitude" => $data->latitude,
                "longitude" => $data->longitude,
            ]);
        }
        //---------------------------------
        $path = __DIR__.'/sources/districts.json';

        $fetch = file_get_contents($path);

        $array = json_decode($fetch);
        foreach($array as $data) {
            RegionalDistrict::create([
                "id" => $data->id,
                "city_id" => $data->regency_id,
                "name" => $data->name,
                "latitude" => $data->latitude,
                "longitude" => $data->longitude,
            ]);
        }
        //---------------------------------
        $path = __DIR__.'/sources/villages.json';

        $fetch = file_get_contents($path);

        $array = json_decode($fetch);
        foreach($array as $data) {
            RegionalVillage::create([
                "id" => $data->id,
                "district_id" => $data->district_id,
                "name" => $data->name,
                "latitude" => $data->latitude,
                "longitude" => $data->longitude,
            ]);
        }
        // //---------------------------------
        // $path = __DIR__.'/source/villages.json';

        // $fetch = file_get_contents($url_source);

        // $array = json_decode($fetch);

    }
}
