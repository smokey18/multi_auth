<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $User = array(
            array('name' => 'Admin', 'email' => 'admin@gmail.com', 'role' => '1', 'picture' => '', 'password' => Hash::make('H@ssan.00')),
            array('name' => 'Kmbo', 'email' => 'kmbo@gmail.com', 'role' => '2', 'picture' => '', 'password' => Hash::make('H@ssan.00')),
            array('name' => 'Daiema', 'email' => 'daiema@gmail.com', 'role' => '2', 'picture' => '', 'password' => Hash::make('H@ssan.00')),
            array('name' => 'Hamnna', 'email' => 'hamnna@gmail.com', 'role' => '2', 'picture' => '', 'password' => Hash::make('H@ssan.00')),
            array('name' => 'Sheikh', 'email' => 'sheikh@gmail.com', 'role' => '3', 'picture' => '', 'password' => Hash::make('H@ssan.00')),
            array('name' => 'Ahmad', 'email' => 'ahmad@gmail.com', 'role' => '3', 'picture' => '', 'password' => Hash::make('H@ssan.00')),
            array('name' => 'Ayesha', 'email' => 'ayesha@gmail.com', 'role' => '3', 'picture' => '', 'password' => Hash::make('H@ssan.00')),
        );

        User::insert($User);
    }
}