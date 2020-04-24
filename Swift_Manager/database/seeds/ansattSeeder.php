<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ansattSeeder extends Seeder 
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('påloggingsinfo')->insert([
            'brukernavn' => 'jjore',
            'passord' => 'jjore',
            'ansatt_idAnsatt' => 1
        ]);
    }
}
