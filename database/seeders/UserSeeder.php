<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**W
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=>'sam',
            'email'=>'sam@hotmail.com',
            'password'=>hash::make('password'),
            'phone_number'=>'0003336',
        ]);

    
        
    }
}
