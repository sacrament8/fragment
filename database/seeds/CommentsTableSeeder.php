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
        for ($board_id = 1; $board_id <= 303; $board_id++) {
            for ($i = 1; $i <= 10; $i++) {
                $user_id = rand(1, 101);
                Comment::create([
                    'content' => User::find($user_id)->name . 'です、こんにちは' . "\n" . 'テスト書き込みさせていただきます。',
                    'user_id' => $user_id,
                    'board_id' => $board_id,
                    'created_at' => Carbon::today(),
                    'updated_at' => Carbon::today(),
                ]);
            }
        }
    }
}
