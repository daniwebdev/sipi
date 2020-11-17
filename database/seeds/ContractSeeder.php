<?php

namespace Database\Seeders;

use App\Models\Contract;
use Illuminate\Database\Seeder;

class ContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 5 ; $i++) { 
            Contract::create([
                "no_contract"          => "233$i/HK8090/PIN.00.00/2015",
                "customer"             => "PT PERUSAHAAN $i",
                "end_customer"         => "Muhamad Yusup Hamdani",
                "project_name"         => "Pekerjaan NMS Untuk Layanan VPN IP di 192 lokasi PT PERUSAHAAN $i",
                "project_year"         => "2015",
                "type_contract"        => "MRC/OTC",
                "start_contract"       => "2020-02-01",
                "end_contract"         => "2020-05-02",
                "total_contract_value" => "20000000",
                "status_contract"      => "Aktif",
            ]);
        }
    }
}
