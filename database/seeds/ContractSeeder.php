<?php

namespace Database\Seeders;

use App\Models\Contract;
use App\Models\Invoice;
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
        $array = [20000000,30000000,43000000,23000000];

        for ($i=1; $i <= 30 ; $i++) {
            $total = $array[rand(0,3)];

            $contract = Contract::create([
                "no_contract"          => "233$i/HK8090/PIN.00.00/2015",
                "customer"             => "PT PERUSAHAAN $i",
                "end_customer"         => "Muhamad Yusup Hamdani",
                "project_name"         => "Pekerjaan NMS Untuk Layanan VPN IP di 192 lokasi PT PERUSAHAAN $i",
                "project_year"         => "2015",
                "type_contract"        => "MRC/OTC",
                "start_contract"       => "2021-02-01",
                "end_contract"         => "2021-05-02",
                "total_contract_value" => $total,
                "balance"              => $total,
                "status_contract"      => 1,
            ]);
            
            $date = rand(1,12);

            $total_inv = $total/12;

            $rand = ['PAID', 'UNPAID', 'KREDIT'];
            $status = $rand[rand(0,2)];

            if($status == 'KREDIT') {
                Invoice::create([
                    "contract_id"     =>  $contract->id,
                    "no_invoice"      =>  '2019/MMT/050'.$i,
                    "date_invoice"    =>  '2021-'.$date.'-03',
                    "periode_invoice" =>  '2021-'.$date.'-03 s/d 2021-'.($date < 11 ? $date+1:$date).'-03',
                    "total_invoice"   =>  $total_inv,
                    "total_bayar"     =>  $total_inv/2,
                    "total_sisa"      =>  $total_inv/2,
                    "status"          =>  $status,
                ]);
            } else if($status == 'UNPAID') {
                Invoice::create([
                    "contract_id"     =>  $contract->id,
                    "no_invoice"      =>  '2019/MMT/050'.$i,
                    "date_invoice"    =>  '2021-'.$date.'-03',
                    "periode_invoice" =>  '2021-'.$date.'-03 s/d 2021-'.($date < 11 ? $date+1:$date).'-03',
                    "total_invoice"   =>  $total_inv,
                    "total_bayar"     =>  0,
                    "total_sisa"      =>  $total_inv,
                    "status"          =>  $status,
                ]);
            } else {
                Invoice::create([
                    "contract_id"     =>  $contract->id,
                    "no_invoice"      =>  '2019/MMT/050'.$i,
                    "date_invoice"    =>  '2021-'.$date.'-03',
                    "periode_invoice" =>  '2021-'.$date.'-03 s/d 2021-'.($date < 11 ? $date+1:$date).'-03',
                    "total_invoice"   =>  $total_inv,
                    "total_bayar"     =>  $total_inv,
                    "total_sisa"      =>  0,
                    "status"          =>  $status,
                ]);
            }
        }
    }
}
