<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class companiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table( 'companies' )->insert( [
            [
                'created_at' => date( 'Y-m-d H:i:s' ),
                'updated_at' => null,
                'company_name'=> 'サントリー',
                'street_adress'=> '東京都',
                'representative_name'=> '清水',
            ],
            [
                'created_at' => date( 'Y-m-d H:i:s' ),
                'updated_at' => null,
                'company_name'=> 'コカ・コーラ',
                'street_adress'=> '群馬',
                'representative_name'=> '二岡',
            ],
            [
                'created_at' => date( 'Y-m-d H:i:s' ),
                'updated_at' => null,
                'company_name'=> 'ヤクルト',
                'street_adress'=> '大阪',
                'representative_name'=> '高橋',
            ],
            [
                'created_at' => date( 'Y-m-d H:i:s' ),
                'updated_at' => null,
                'company_name'=> 'アサヒ',
                'street_adress'=> '福岡',
                'representative_name'=> '松井',
            ],
        ] );
    }
}
