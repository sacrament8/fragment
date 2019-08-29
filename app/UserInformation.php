<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    protected $table = 'user_informations';
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
