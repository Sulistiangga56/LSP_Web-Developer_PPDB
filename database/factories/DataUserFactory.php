<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DataUser>
 */
class DataUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Nm_pendaftar' => $this->faker->name(),
            'Alamat' => $this->faker->address(),
            'Jenis_kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'No_hp' => $this->faker->phoneNumber(),
            'Asal_sekolah' => $this->faker->company(),
            'Jurusan' => $this->faker->randomElement(['RPL', 'TKJ', 'MM']),
            'Tgl_lahir' => $this->faker->date(),
            'NISN' => $this->faker->randomNumber(),
        ];
    }
}
