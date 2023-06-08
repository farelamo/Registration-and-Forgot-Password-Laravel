<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->email(),
            'username' => fake()->unique()->word(),
            'posisi' => 'kitchen',
            'role' => 'pegawai',
            'gender' => 'L',
            'type' => 'full',
            'domisili' => 'malang',
            'telp' => rand(1000000, 5000000),
            'password' => bcrypt('rahasia'),
        ];
    }
}
