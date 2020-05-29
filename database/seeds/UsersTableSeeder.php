<?php

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    public function run () {

        Model::unguard();
        User::create([
            'username'          => 'admin',
            'name'              => 'Admin User 1',
            'email'             => 'admin@example.com',
            'email_verified_at' => now(),
            'password'          => '123456',
            'remember_token'    => Str::random(10),
        ]);
        User::create([
            'username'          => 'admin2',
            'name'              => 'Admin User 2',
            'email'             => 'admin2@example.com',
            'email_verified_at' => now(),
            'password'          => '123456',
            'remember_token'    => Str::random(10),
        ]);
        User::create([
            'username'          => 'admin3',
            'name'              => 'Admin User 3',
            'email'             => 'admin3@example.com',
            'email_verified_at' => now(),
            'password'          => '123456',
            'remember_token'    => Str::random(10),
        ]);
        User::create([
            'username'          => 'admin4',
            'name'              => 'Admin User 4',
            'email'             => 'admin4@example.com',
            'email_verified_at' => now(),
            'password'          => '123456',
            'remember_token'    => Str::random(10),
        ]);
        Model::reguard();

        factory(User::class, 50)->create();
    }
}
