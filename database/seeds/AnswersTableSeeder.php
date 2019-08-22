<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Answer;
use App\Post;

class AnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Answer::truncate();
        $testCode = <<< 'EOD'
        public function getDate()
        {
            return $this->created_at;
        }
EOD;
        // 生成した303件のPostの持つAnswerレコードを3件づつ生成
        for ($post_id = 1; $post_id <= 303; $post_id++) {
            for ($answer_count = 1; $answer_count <= 3; $answer_count++) {
                Answer::create([
                    'content' => '回答内容その' . $answer_count,
                    'src' => $testCode,
                    'post_id' => $post_id,
                    'user_id' => rand(1, 101),
                ]);
            }
        }
    }
}
