<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username'=>'admin desa',
            'password'=> Hash::make('admin12345'),
            'jabatan'=>'admin desa',
            'nama'=>'Admin Desa'
        ]);

        User::create([
            'username'=>'admin kecamatan',
            'password'=> Hash::make('admin12345'),
            'jabatan'=>'admin kecamatan',
            'nama'=>'Admin Desa'
        ]);
    }
}
