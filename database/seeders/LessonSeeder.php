<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!Lesson::where('name', 'Aula 1')->exists()) {
            Lesson::create([
                'name' => 'Aula 1',
                'description' => 'Descrição da aula 1',
                'order_lesson' => 1,
                'course_id' => 1, //chave estrangeira, se refere ao curso de id 1
            ]);
        }
        if(!Lesson::where('name', 'Aula 2')->exists()) {
            Lesson::create([
                'name' => 'Aula 2',
                'description' => 'Descrição da aula 2',
                'order_lesson' => 2,
                'course_id' => 1, //chave estrangeira, se refere ao curso de id 1
            ]);
        }
        if(!Lesson::where('name', 'Aula 1B')->exists()) {
            Lesson::create([
                'name' => 'Aula 1B',
                'description' => 'Descrição da aula 1B',
                'order_lesson' => 1,
                'course_id' => 10, //chave estrangeira, se refere ao curso de id 10
            ]);
        }
    }
}
