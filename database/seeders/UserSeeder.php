<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //         'name','email','password',
        User::create([
            'name'=> 'Tobias',
            'email'=>'Tobias@gmail.com',
            'password'=>bcrypt(12345678)
        ]);
    }
}
