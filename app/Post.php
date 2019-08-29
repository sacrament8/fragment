<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Answer;

class Post extends Model
{
    protected $fillable = [
        'title', 'content', 'src',
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    public function getCreatedDate()
    {
        return $this->created_at->format('Y年m月d日');
    }

    public function getHasAnswerCount($post_id)
    {
        return Answer::where('post_id', $post_id)->count();
    }
}
