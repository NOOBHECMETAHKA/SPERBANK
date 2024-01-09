<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\Banks::factory(10)->create();
        \App\Models\CardTypes::factory(10)->create();
        \App\Models\OperationTypes::factory(10)->create();
        \App\Models\ScoreType::factory(10)->create();
        DB::table(Roles::$tableName)->insertOrIgnore(Roles::makeSeedInfo());

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
