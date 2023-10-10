<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GarbageTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('garbage_types')->delete();
        
        \DB::table('garbage_types')->insert(array (
            0 => 
            array (
                'color' => '#000000',
                'created_at' => '2023-09-16 05:08:14',
                'description' => NULL,
                'id' => 2,
                'name' => 'Kaca',
                'photo' => 'images/photo/meja-kantor.jpeg',
                'price' => 10000.0,
                'updated_at' => '2023-09-16 07:34:29',
            ),
            1 => 
            array (
                'color' => '#ca9191',
                'created_at' => '2023-09-16 05:08:34',
                'description' => NULL,
                'id' => 3,
                'name' => 'Plastik',
                'photo' => 'images/photo/mobil.jpeg',
                'price' => 50000.0,
                'updated_at' => '2023-09-16 07:34:24',
            ),
            2 => 
            array (
                'color' => '#e60505',
                'created_at' => '2023-09-16 07:33:26',
                'description' => 'tes',
                'id' => 4,
                'name' => 'Kaleng',
                'photo' => 'images/photo/mobil.jpeg',
                'price' => 10000.0,
                'updated_at' => '2023-09-16 07:33:26',
            ),
        ));
        
        
    }
}