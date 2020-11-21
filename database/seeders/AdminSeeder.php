<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id' => '1',
            'store_id' => "1",
            'name' => 'Admin',
            'email' => 'admin@rezeipt.online',
            'email_verified_at' => now(),
            'password' => Hash::make('8w[?hBR:Ju2Gm'),
            'role' => 0,
            'admin' => 1,
            'approved_at' => now(),
        ]);

        Profile::create(['user_id' => '1']);
    }
}
