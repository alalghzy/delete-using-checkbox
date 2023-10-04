<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Membuat dan menyimpan 10 data palsu menggunakan factory
        \App\Models\Student::factory(10)->create();
    }
}
