<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create(['name'=>'admin']);
         \App\Models\User::factory(100)->create()->each(
             fn ($user)=>$user->assignRole('admin')
         );
         \App\Models\User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
             'password' => Hash::make('123')
         ])->assignRole('admin');
    }
}
