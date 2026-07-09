<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
        ]);

        User::factory(1)->afterCreating(function ($model) {
            $model->email = 'test@test.ru';
            $model->save();

            $model->assignRole(RoleEnum::admin);
            $model->assignRole(RoleEnum::user);
        })->create();
    }
}
