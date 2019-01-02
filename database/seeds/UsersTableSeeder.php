<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
User::create([
'name' => 'Emmanuel Administrador',
'email'=> 'escorpio8924@gmail.com',
'password' => bcrypt('892647'),
'admin' => true
]);

User::create([
'name' => 'Francisco Administrador',
'email'=> 'escorpio8924@hotmail.com',
'password' => bcrypt('892647'),
'admin' => true
]);
    }
}
