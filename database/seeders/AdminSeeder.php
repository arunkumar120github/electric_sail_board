<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate([
            'email' => 'vivek@provistechnologies.com'
        ],[
            'role' => 'Admin',
            'name' => 'Vivek Sharma',
            'password' => bcrypt('1234567890')
        ]);
    }
}
