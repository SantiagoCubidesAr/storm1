<?php

namespace Database\Factories;

use App\Models\Gender;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UserFactory extends Factory
{
    const ROLES = ['Conductor', 'Menor', 'Administrador', 'Tutor'];
    protected static ?string $password;
    public function definition(): array
    {
        $status = fake()->randomElement(array(1,2));
        $photo = fake()->image(public_path('images/'), 140, 140, null, false);
        return [
            'id_status' => $status,
            'fullname' => fake()->name(),
            'photo' => $photo,
            'id_gender' => fake()->randomElement([1,2]),
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
            $role = Role::firstOrNew(['name' => fake()->randomElement(self::ROLES)]);
            if (!$role->exists) {
                $role->save();
            }
            $user->roles()->attach($role->id);
        });
    }
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
