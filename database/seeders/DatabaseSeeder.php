<?php

namespace Database\Seeders;

use App\Models\ElectionMember;
use App\Models\MrtMember;
use App\Models\MrtRecord;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // \App\Models\User::factory(10)->create();
        // DB::table('users')->insert([
        //     'name' => Str::random(10),
        //     'email' => Str::random(10) . '@gmail.com',
        //     'password' => Hash::make('password'),
        // ]);
        // MrtMember::factory()
        //     ->count(10)
        //     ->create();
        // MrtRecord::factory()
        //     ->count(100)
        //     ->create();
        ElectionMember::factory()
            ->times(1000)
            ->hasVotes(6)
            ->create();
    }
}
