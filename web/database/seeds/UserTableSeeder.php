<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'first_name' => 'Gregory',
            'last_name' => 'Sanchez',
            'username' => 'mcgregox',
            'email'=> 'mcgregox@gmail.com',
            'active' => true,
            'password' => bcrypt('123456'),
            'role' => 'admin',
        ]);

        factory(User::class, 19)->create();

    }
}
