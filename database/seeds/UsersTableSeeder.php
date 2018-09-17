<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = \Faker\Factory::create();

              $password = Hash::make('password');
              $role = ['Admin', 'User', 'Guest'];
              $domain = '@bookly.com';

              User::create([
                  'name' => 'Administrator',
                  'email' => 'admin@bookly.com',
                  'password' => $password,
                  'role' => $role[0],
              ]);

              for ($i = 0; $i < 5; $i++) {
                  User::create([
                      'name' => $faker->name,
                      'email' => strtolower($faker->firstNameMale).$domain,
                      'password' => $password,
                      'role' => $role[1],
                  ]);
              }

              for ($i = 0; $i < 5; $i++) {
                  User::create([
                      'name' => $faker->name,
                      'email' => strtolower($faker->firstNameMale).$domain,
                      'password' => $password,
                      'role' => $role[2],
                  ]);
              }
    }
}
