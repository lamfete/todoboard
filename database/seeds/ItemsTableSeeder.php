<?php

use Illuminate\Database\Seeder;
use App\Item as Item;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->delete();

        $items = array(
            [
                'body' => 'menu master users',
                'user_id' => 1,
                'pic_id' => 0,
                'status_id' => 1
            ],
            [
                'body' => 'menu master status',
                'user_id' => 1,
                'pic_id' => 0,
                'status_id' => 1
            ],
            [
                'body' => 'login page',
                'user_id' => 1,
                'pic_id' => 0,
                'status_id' => 1
            ],
            [
                'body' => 'menu master items',
                'user_id' => 1,
                'pic_id' => 0,
                'status_id' => 1
            ],
        );

        foreach ($items as $item) {
        	Item::create($item);
        }
    }
}
