<?php


namespace Uzair3\Attendance\Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Leave;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Leave>
 */
class LeaveFactory extends Factory
{
    protected $model = Leave::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Creates a user if not already existing
            'from' => $this->faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
            'to' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'reason' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['Pending', 'Approved', 'Rejected']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
