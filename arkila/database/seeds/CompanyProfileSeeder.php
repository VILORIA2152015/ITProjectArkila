<?php

use Illuminate\Database\Seeder;
use App\profile;

class CompanyProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        profile::create([
            'email' => 'banTrans@gmail.com',
            'contact_number' => '635-232-3332',
            'address' => '21 kisa huhu baguio'
        ]);
    }
}
