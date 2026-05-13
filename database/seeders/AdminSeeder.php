<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\UserAccount;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kiểm tra admin đã tồn tại chưa
        $adminExists = User::where('role', 0)->exists();

        // Nếu chưa có thì tạo
        if (!$adminExists) {

            User::create([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456'),

                'id_number' => 'ADMIN001',
                'address' => 'System',

                'role' => 0, // admin
                'status' => 1,

                'gender' => 'male',
                'phone' => '0123456789',

                'img' => null,
            ]);

            echo "Admin account created successfully.\n";

        } else {

            echo "Admin already exists.\n";
        }
    }
}