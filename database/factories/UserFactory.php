<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Admin admin',
            'email' => 'adminln@yopmail.com',
            'email_verified_at' => now(),
            'isAdmin' => 1,
            'userType_id' => 1,
            'username' => 'admin',
            'password' => '$2a$10$S6RAT1YG2dQ2mnzXJp1xEOsXppcmygjMcO2KQGAqWE7WLJOWuJPuG', // admin
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
