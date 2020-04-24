<?php

use Illuminate\Database\Seeder;
use App\Ansatte;

class AnsattTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('ansatte')->delete();
        Ansatte::create([
            'name' => 'jonas jore',
            'email' => 'jonas@gmail.com',
            'password' => bcrypt('jonastest1')
        ]);
    }
}
