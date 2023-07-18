<?php

namespace Database\Seeders;

use App\Models\Type;

use Faker\Generator;
use App\Models\Project;
use App\Models\Technology;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Generator $faker)
    {

        $types = Type::all();
        $types->shift();

        $technologies = Technology::all()->pluck('id')->all();

        for ($i = 0; $i < 50; $i++) {

            $title = $faker->words(rand(2, 10), true);
            $slug = Project::slugger($title);
            $imageIndex = rand(0, 9);

            $project = Project::create([

                'type_id' => $faker->randomElement($types)->id,
                'title' => Str::ucfirst($title),
                'slug' => $slug,
                'image' => $imageIndex ? 'uploads/avatar' . $imageIndex . '.jpg' : null,
                'description' => $faker->paragraphs(rand(2, 5), true),
                'repo' => $faker->words(rand(2, 10), true),

            ]);

            //associare projects alle technologies

            $project->technologies()->sync($faker->randomElements($technologies, null));
        }
    }
}
