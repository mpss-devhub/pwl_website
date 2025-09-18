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
            'user_group' => 'Super Admin',
            'permission' => 'S-U-AA-AN-T-L-M',
            'allowed' => 'S:C,E;U:C,U,D;AA:C,U,D;AN:C,U,D;T:E,P,TD;L:E,R,V,U;M:C,U,D,S,I,M',
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
    }
}
