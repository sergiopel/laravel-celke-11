<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Course::factory(20)->create();

        // Incluo um a um exemplos de cursos, verificando se já existe, e caso existir, não irá incluir novamente
        if(!Course::where('name', 'Course 1')->exists()) { // no lugar do ->exists() o professor colocou ->first()
                                                           // e o funcionamento foi o mesmo
            Course::create([
                'name' => 'Course 1',
                'price' => 197.43,
            ]);
        }
        if(!Course::where('name', 'Course 2')->exists()) {
            Course::create([
                'name' => 'Course 2',
                'price' => 147.44,
            ]);
        }
        if(!Course::where('name', 'Course 3')->exists()) {
            Course::create([
                'name' => 'Course 3',
                'price' => 287.13,
            ]);
        }
        if(!Course::where('name', 'Course 4')->exists()) {
            Course::create([
                'name' => 'Course 4',
                'price' => 99.53,
            ]);
        }
    }
}
