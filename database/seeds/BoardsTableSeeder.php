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
                $start = Carbon::create("2019", "1", "1", "0", "0");
                $end = Carbon::create("2019", "9", "5", "0", "0");
                $min = strtotime($start);
                $max = strtotime($end);
                $date = rand($min, $max);
                $date = date('Y-m-d', $date);
                Board::create([
                    'title' => User::find($user_id)->name . 'が立てたスレッド' . $i,
                    'content' => User::find($user_id)->name . 'が立てたスレッドです、自由に書き込んでください。',
                    'user_id' => $user_id,
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
            }
        }
    }
}
