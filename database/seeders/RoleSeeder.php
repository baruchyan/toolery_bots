<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        collect(RoleEnum::cases())->each(function (RoleEnum $role) {
            try {
                Role::create(['name' => $role->value, 'guard_name' => 'web']);
            } catch (\Exception $exception) {
                echo $exception->getMessage() . "\n";
            }
        });
    }
}
