<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = fake()->randomElement(array('Female', 'Male'));
        $status = fake()->randomElement(array('Activo', 'Inactivo'));
        $photo = fake()->image(public_path('images/'), 140, 140, null, false);
        return [
            'status' => $status,
            'fullname' => fake()->name(),
            'gender' => $gender,
            'photo' => $photo,
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('12345'),
            'remember_token' => Str::random(10),
        ];
    }

    public function configure(): self
    {
        return $this->afterCreating(function (User $user) {
            $role = Role::factory()->create(['name' => fake()->randomElement(array('Conductor', 'Menor', 'Administrador', 'Tutor'))]);
            $user->roles()->attach($role->id);
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
