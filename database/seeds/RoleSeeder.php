<?php
use TrusCRUD\Core\Models\AccessRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        AccessRole::create([
            "name" => "Super Admin",
            "description" => "Top Level User",
            "uuid" => Str::uuid()
        ]);
        //
        AccessRole::create([
            "name" => "User",
            "description" => "Public User",
            "uuid" => Str::uuid()
        ]);

    }
}
