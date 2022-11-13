<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        User::insert([
            'email' => 'romvas44@gmail.com',
            'password' => Hash::make('123'),
            'name_surname' => 'Роман Ващук',
            'patronymic' => 'Андрійович',
            'phone_number' => '+380987654321',
            'other_info' => 'Заступник директора, вчитель інформатики',
            'role_id' => 3
        ]);
    }
}
