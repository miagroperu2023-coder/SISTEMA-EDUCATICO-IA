<?php

namespace Database\Seeders;

use App\Models\Audience;
use App\Models\Course;
use App\Models\Description;
use App\Models\Goal;
use App\Models\Image;
use App\Models\Lesson;
use App\Models\Requirement;
use App\Models\Section;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $courses = Course::factory(10)->create();

        //RECORRIENDO COLECCION Y LLENANDO A QUE IMAGEN LE PERTENECE EL ID DEL CURSO
        foreach ($courses as $course) {
            //UN CURSO TIENE UNA IMAGEN
            Image::factory(1)->create([
                'imageable_id' => $course->id,
                'imageable_type' => 'App\Models\Course' //AL MODELO DEL CURSO
            ]);

            //LLENADO DE DATOS AL REQUIREMENT DESPUES DE CREAR EL CURSO
            Requirement::factory(4)->create([
                'course_id' => $course->id
            ]);

            //LLENADO DE DATOS AL GOAL DESPUES DE CREAR EL CURSO
            Goal::factory(4)->create([
                'course_id' => $course->id
            ]);

            //LLENADO DE DATOS AUDIENCE DESPUES DE CREAR EL CURSO
            Audience::factory(4)->create([
                'course_id' => $course->id
            ]);

            //LLENADO DE DATOS AL SECTION DESPUES DE CREAR EL CURSO
            $sections = Section::factory(4)->create([
                'course_id' => $course->id
            ]);

            //LENADO DE LOS LESSONS Y DESCRIPTION
            foreach ($sections as $section) {
                $lessons = Lesson::factory(4)->create([
                    'section_id' => $section->id
                ]);

                foreach ($lessons as $lesson) {
                    Description::factory(1)->create([
                        'lesson_id' => $lesson->id
                    ]);
                }
            }
        }
    }
}
