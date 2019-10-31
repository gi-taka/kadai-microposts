<?php

use Illuminate\Database\Seeder;

class MicropostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 2; $i++) {
            DB::table('users')->insert([
                'name' => 'user' . $i,
                'email' => 'user' . $i . '@mail.com',
                'password' => bcrypt('password'),
            ]);
        }
        for($i = 1; $i <= 6; $i++) {
            if($i%2 == 0) {
                DB::table('microposts')->insert([
                    'user_id' => 2,
                    'content' => $i,
                ]);
            } else {
                DB::table('microposts')->insert([
                    'user_id' => 1,
                    'content' => $i,
                ]);
            }
        }
    }
}
