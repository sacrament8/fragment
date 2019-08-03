<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function board()
    {
        return $this->belongsTo('App\Board');
    }

    public function getCreatedDate()
    {
        return $this->created_at->format('Y年m月d日 H:i');
    }
}
