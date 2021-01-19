<?php

use Illuminate\Database\Seeder;
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
       $admin= \App\Models\User::create([
           'name'=>'admin',
           'email'=>'admin@admin.com',
           'password'=>bcrypt(123456789)
        ]);
       $admin->channel->create([
           'name'=>$admin->name,
       ]);
        $test=\App\Models\User::create([
            'name'=>'test',
            'email'=>'test@test.com',
            'password'=>bcrypt(123456789)
        ]);
        $test->channel->create([
            'name'=>$test->name,
        ]);
    }
}
