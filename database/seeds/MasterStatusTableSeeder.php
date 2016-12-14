<?php

use Illuminate\Database\Seeder;
use App\MasterStatus as MasterStatus;

class MasterStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_statuses')->delete();

        $master_status = array(
            ['name' => 'open'],
            ['name' => 'on going'],
            ['name' => 'done'],
        );

        foreach ($master_status as $status) {
        	MasterStatus::create($status);
        }
    }
}
