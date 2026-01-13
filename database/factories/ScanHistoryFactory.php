<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ScanHistory>
 */
class ScanHistoryFactory extends Factory
{
    public function definition(): array
    {
        $types = ['url', 'email', 'phone', 'text'];
        $type = fake()->randomElement($types);

        return [
            'content' => match ($type) {
                'url' => fake()->url(),
                'email' => fake()->email(),
                'phone' => fake()->phoneNumber(),
                default => fake()->sentence(),
            },
            'format' => fake()->randomElement(['QR_CODE', 'EAN_13', 'CODE_128', 'UPC_A']),
            'type' => $type,
        ];
    }

    public function url(): static
    {
        return $this->state(fn (array $attributes) => [
            'content' => fake()->url(),
            'type' => 'url',
        ]);
    }

    public function email(): static
    {
        return $this->state(fn (array $attributes) => [
            'content' => fake()->email(),
            'type' => 'email',
        ]);
    }

    public function phone(): static
    {
        return $this->state(fn (array $attributes) => [
            'content' => fake()->phoneNumber(),
            'type' => 'phone',
        ]);
    }
}
