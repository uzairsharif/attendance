<?php

namespace Uzair3\Attendance\Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Generate random times for check-in and check-out on the same day
        $date = $this->faker->dateTimeBetween('-1 year', 'now');

        $checkIn = Carbon::parse($date)->setTime($this->faker->numberBetween(8, 10), $this->faker->numberBetween(0, 59));
        $checkOut = (clone $checkIn)->addHours($this->faker->numberBetween(6, 9));
        // $checkInTime = $checkIn->format('H:i:s');
        // $checkOutTime = $checkOut->format('H:i:s');
        return [
            'user_id' => User::factory(), // Assumes a UserFactory exists
            'date' => $checkIn->toDateString(),
            'check_in' => $checkIn,
            'in_status' => $this->faker->randomElement(['On Time', 'Late']),
            'check_out' => $checkOut,
            'out_status' => $this->faker->randomElement(['On Time', 'Early', 'Overtime']),
        ];
    }
}
