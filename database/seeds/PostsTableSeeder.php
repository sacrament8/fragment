<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Post;
use App\User;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
        $testCode = <<< 'EOD'
public function update(UpdateAnswer $request, int $post_id, int $answer_id)
{
    $post = Post::find($post_id);
    $answer = Answer::find($answer_id);
    $answer->src = $request->src;
    $answer->content = $request->content;
    $answer->save();
    return redirect()->route('posts.show', [
        'id'=>$post->id,
    ]);
}
EOD;

        // 質問投稿ダミーデータ
        for ($user_id = 1; $user_id <= 101; $user_id++) {
            for ($post_count = 1; $post_count <= 3; $post_count++) {
                $start = Carbon::create("2019", "1", "1", "0", "0");
                $end = Carbon::create("2019", "9", "5", "0", "0");
                $min = strtotime($start);
                $max = strtotime($end);
                $date = rand($min, $max);
                $date = date('Y-m-d', $date);
                Post::create([
                    'title' => User::find($user_id)->name . 'の質問投稿' . $post_count,
                    'src' => $testCode,
                    'content' => '質問の内容 その' . $post_count,
                    'user_id' => $user_id,
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
            }
        }
    }
}
