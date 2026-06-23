<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name' => $this->faker->sentence(),
            'url' => 'https://www.youtube.com/watch?v=r9D33ZTgVW8&ab_channel=AnthonyEduardoNu%C3%B1ezCanchari',
            'iframe' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/r9D33ZTgVW8?si=I97_2d5O5zOs8I3X" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>',
            'platform_id' => 1
        ];
    }
}
