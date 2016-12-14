<?php

use Illuminate\Database\Seeder;
use App\User as User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $users = array(
        	['name' => 'Agust Lofianto', 'email' => 'agust.wtu@wavin.co.id', 'password' => Hash::make('1234')],
            ['name' => 'Riki Sholiardi', 'email' => 'riki.wtu@wavin.co.id', 'password' => Hash::make('1234')],
            ['name' => 'Alparisyi', 'email' => 'faris.wtu@wavin.co.id', 'password' => Hash::make('1234')],
            ['name' => 'Udin', 'email' => 'nasrudin.wtu@wavin.co.id', 'password' => Hash::make('1234')],
        );

        foreach ($users as $user) {
        	User::create($user);
        }
    }
}
