<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Answer extends Model
{
    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    public function getCreatedDate()
    {
        return $this->created_at->format('Y年m月d日 H:i');
    }
}
