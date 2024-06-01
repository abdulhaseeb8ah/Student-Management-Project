<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\SidebarItem;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'username' => 'hazim',
                'password' => Hash::make('hazim123'),
                'role' => 'student',
                'email' => 'hazim@gmail.com',
                'profile_picture' => 'storage/profile_pictures/RMWLQD4lroYmLjv9bA17pLmu9ycm928RfsQoiqsW.jpg',
                'status' => 'inactive',
                'admin_approved' => 'no',
                'created_at' => '2024-05-17 03:40:51',
                'updated_at' => '2024-05-17 16:42:14',
            ],
            [
                'username' => 'hameed',
                'password' => Hash::make('hameed123'),
                'role' => 'student',
                'email' => 'hameed@gmail.com',
                'profile_picture' => 'storage/profile_pictures/j6nqs3UN9KNeCWSeTneqU44Pms3cuMqlbWQSwgyc.jpg',
                'status' => 'inactive',
                'admin_approved' => 'no',
                'created_at' => '2024-05-17 03:44:55',
                'updated_at' => '2024-05-17 03:44:55',
            ],
            [
                'username' => 'ahmed',
                'password' => Hash::make('ahmed123'),
                'role' => 'student',
                'email' => 'ahmed@gmail.com',
                'profile_picture' => 'storage/profile_pictures/eijxAqnVuYDQzR7SPWY0S33n81oSQgypKo9e2Ite.jpg',
                'status' => 'inactive',
                'admin_approved' => 'no',
                'created_at' => '2024-05-17 03:47:29',
                'updated_at' => '2024-05-17 03:47:29',
            ],
            [
                'username' => 'bilal',
                'password' => Hash::make('bilal123'),
                'role' => 'faculty',
                'email' => 'bilal@gmail.com',
                'profile_picture' => 'storage/profile_pictures/RMWLQD4lroYmLjv9bA17pLmu9ycm928RfsQoiqsW.jpg',
                'status' => 'inactive',
                'admin_approved' => 'no',
                'created_at' => '2024-05-17 13:25:03',
                'updated_at' => '2024-05-17 13:25:03',
            ],
            [
                'username' => 'danish',
                'password' => Hash::make('danish123'),
                'role' => 'admin',
                'email' => 'danish@gmail.com',
                'profile_picture' => 'storage/profile_pictures/eijxAqnVuYDQzR7SPWY0S33n81oSQgypKo9e2Ite.jpg',
                'status' => 'inactive',
                'admin_approved' => 'no',
                'created_at' => '2024-05-17 13:30:37',
                'updated_at' => '2024-05-17 13:30:37',
            ],
        ];

        $sidebarItems = [
            [
                'role' => 'admin',
                'sidebar_items_json' => '["Registration Request", "Users", "Course Offer", "Assign Courses"]',
            ],
            [
                'role' => 'faculty',
                'sidebar_items_json' => '["Add Marks", "Mark Attendance"]',
            ],
            [
                'role' => 'student',
                'sidebar_items_json' => '["View Attendance", "View Marks", "Update Details"]',
            ],
        ];

        foreach ($sidebarItems as $item) {
            SidebarItem::create($item);
        }

        foreach ($userData as $user) {
            User::create($user);
        }
    }
}
