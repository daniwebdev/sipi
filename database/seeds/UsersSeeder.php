<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'uuid'              => Str::uuid(),
            'name'              => 'Muhamad Yusup Hamdani',
            'phone'             => '085717453300',
            'access_role_id'    => 1,
            'email'             => 'super@mail.com',
            'password'          => bcrypt('password'),
        ]);

        User::create([
            'uuid'              => Str::uuid(),
            'name'              => 'Admin SIPI',
            'phone'             => '0857123123123',
            'access_role_id'    => 2,
            'email'             => 'admin@mail.com',
            'password'          => bcrypt('password'),
        ]);

        User::create([
            'uuid'              => Str::uuid(),
            'name'              => 'Finance',
            'phone'             => '0857123123000',
            'access_role_id'    => 3,
            'email'             => 'finance@mail.com',
            'password'          => bcrypt('password'),
        ]);

        User::create([
            'uuid'              => Str::uuid(),
            'name'              => 'Collection',
            'phone'             => '0857123123000',
            'access_role_id'    => 4,
            'email'             => 'collection@mail.com',
            'password'          => bcrypt('password'),
        ]);

    }
}
