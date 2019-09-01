<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Comment;
use Carbon\Carbon;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($board_id = 2; $board_id <= 304; $board_id++) {
            for ($i = 1; $i <= 10; $i++) {
                $user_id = rand(1, 101);
                $start = Carbon::create("2019", "1", "1", "0", "0");
                $end = Carbon::create("2019", "9", "5", "0", "0");
                $min = strtotime($start);
                $max = strtotime($end);
                $date = rand($min, $max);
                $date = date('Y-m-d', $date);
                Comment::create([
                    'content' => User::find($user_id)->name . 'です、こんにちは' . "\n" . 'テスト書き込みさせていただきます。',
                    'user_id' => $user_id,
                    'board_id' => $board_id,
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
            }
        }
    }
}
