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
                'street_address'=> '東京都',
                'representative_name'=> '清水',
            ],
            [
                'created_at' => date( 'Y-m-d H:i:s' ),
                'updated_at' => null,
                'company_name'=> 'コカ・コーラ',
                'street_address'=> '群馬',
                'representative_name'=> '二岡',
            ],
            [
                'created_at' => date( 'Y-m-d H:i:s' ),
                'updated_at' => null,
                'company_name'=> 'ヤクルト',
                'street_address'=> '大阪',
                'representative_name'=> '高橋',
            ],
            [
                'created_at' => date( 'Y-m-d H:i:s' ),
                'updated_at' => null,
                'company_name'=> 'アサヒ',
                'street_address'=> '福岡',
                'representative_name'=> '松井',
            ],
        ] );
    }
}
