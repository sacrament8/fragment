<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Board;
use App\User;

class BoardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($user_id = 1; $user_id <= 101; $user_id++) {
            for ($i = 1; $i <= 3; $i++) {
                Board::create([
                    'title' => User::find($user_id)->name . 'が立てたスレッド' . $i,
                    'content' => User::find($user_id)->name . 'が立てたスレッドです、自由に書き込んでください。',
                    'user_id' => $user_id,
                    'created_at' => Carbon::today(),
                    'updated_at' => Carbon::today(),
                ]);
            }
        }
    }
}
