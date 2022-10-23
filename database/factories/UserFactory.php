<?php

namespace Database\Factories;

use Faker\Provider\en_US\Address;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $this->faker->addProvider(new Address($this->faker));
        return [
            'name' => fake()->name(),
            'email' => $email =  fake()->unique()->safeEmail(),
            'username' => strstr($email,'@', true) . rand(100, 128),
            'city' => rand(0,1) ===0 ? NULL : $this->faker->city(),
            'country' => rand(0,1) ===0 ? NULL : $this->faker->country(),
            'about_me' => rand(0,1) ===0 ? NULL : $this->faker->text(),
            'email_verified_at' => now(),
            'password' => Hash::make('12345'), // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
