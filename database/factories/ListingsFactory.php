<?php

namespace Database\Factories;

use App\Models\Listings;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ListingsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Listings::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $data = DB::table('cars')->inRandomOrder()->first();
        $title = $data->make . " " . $data->model;
        $hashed = Hash::make($title, ['rounds' => 12]);
        $title = $title . "-" . $hashed;
        $cubic = $this->faker->numberBetween(1000, 5000);
        $litres = number_format(round($cubic/1000,1),1);

        return [
            'title' => $data->make . " " . $data->model . " " . $litres,
            'make' => $data->make,
            'model' => $data->model,
            'year' => $this->faker->numberBetween($data->year_from, $data->year_to),
            'slug' => Str::slug($title,'-'),
            'price' => $this->faker->numberBetween(0, 100000),
            'cubic' => $cubic,
            'mileage' => $this->faker->numberBetween(10000, 500000),
            'fuel_id' => $this->faker->numberBetween(1, 5),
            'gearbox_id' => $this->faker->numberBetween(1, 3),
            'colour' => $this->faker->colorName(),
            'description' => $this->faker->realText(800),
            'hp' => $this->faker->numberBetween(50, 500),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'telephone' => $this->faker->phoneNumber(),
            'town' => $this->faker->city(),
        ];
    }
}
