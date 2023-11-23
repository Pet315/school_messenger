<?php

namespace Database\Seeders;

use App\Models\SchoolClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i<12; $i++) {
            $year = (string) $i;
            SchoolClass::insert([
                'name' => $year.'-А',
            ]);
            SchoolClass::insert([
                'name' => $year.'-Б',
            ]);
            SchoolClass::insert([
                'name' => $year.'-В',
            ]);
        }
    }
}
