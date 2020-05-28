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
            'name'              => 'Admin User',
            'email'             => 'admin@example.com',
            'email_verified_at' => now(),
            'password'          => '123456',
            'remember_token'    => Str::random(10),
        ]);
        Model::reguard();

        factory(User::class, 50)->create();
    }
}
