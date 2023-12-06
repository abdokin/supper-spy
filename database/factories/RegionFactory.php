<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Region>
 */
class RegionFactory extends Factory
{
    
    protected $model = Region::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->streetName,
            'status' => $this->faker->randomElement(Region::STATUSES),
        ];
    }

    public function cities($count = 3)
    {
        return $this->has(
            City::factory()
                ->count($count)
                ->state(function (array $attributes, Region $region) {
                    return ['region_id' => $region->id];
                })
        );
    }
}
