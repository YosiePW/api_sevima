<?php

use Illuminate\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'id'=> 1,
        	'nama' => 'Yosieka Putri Wibawa',
            'email' => 'c@c.c',
            'password' => bcrypt('123456'),
        	'level' => 'admin'
        ]);
    }
}
