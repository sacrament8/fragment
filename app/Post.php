<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'content', 'src',
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function getPostDate()
    {
        return $this->created_at->format('Y年m月d日 H:i');
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }
}
