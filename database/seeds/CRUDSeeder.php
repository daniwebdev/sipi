<?php
namespace Database\Seeds;

use Illuminate\Database\Seeder;

class CRUDSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Core
        $this->call(UsersSeeder::class);
        $this->call(UserProviderSeeder::class);
        $this->call(PermissionAction::class);
        $this->call(RoleSeeder::class);
        // $this->call(RegionalProvinceSeeder::class);
    }
}
