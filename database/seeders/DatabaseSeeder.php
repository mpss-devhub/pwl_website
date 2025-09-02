<?php

namespace Database\Seeders;

use App\Models\Permissions;
use App\Models\User;
use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Permissions::create([
            'user_group' => 'Admin',
            'permission' => 'T-L-M-U-AA-AN-S',
            'allowed' => 'T:E,P,TD;L:E,R,V,U;M:E,C,U,D,S,I,M;U:C,U,D;AA:C,U,D;AN:C,U,D;S:C,E',
        ]);


        // User::factory(10)->create();
        User::factory()->create([
            'user_id' => 'OCT_H5131',
            'name' => 'MPSS merchant',
            'email' => 'mpss@merchant.com',
            'phone' => '09447710052',
            'role' => 'admin',
            'status' => 'on',
            'email_verified_at' => Carbon::now(),
            'permission_id' => '1',
            'password' => Hash::make(447710052),
        ]);

        User::factory()->create([
            'user_id' => 'OCT_L5515',
            'name' => 'MPSS Admin',
            'email' => 'mpss@admin.com',
            'phone' => '09447710052',
            'role' => 'admin',
            'status' => 'on',
            'permission_id' => '1',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make(447710052),
        ]);
    }
}
