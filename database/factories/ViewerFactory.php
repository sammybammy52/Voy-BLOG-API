<?php
namespace Database\Factories;

use App\Models\Viewer;
use Illuminate\Database\Eloquent\Factories\Factory;

class ViewerFactory extends Factory
{
    protected $model = Viewer::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}
