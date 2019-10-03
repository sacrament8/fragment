<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\FollowUser;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function boards()
    {
        return $this->hasMany('App\Board');
    }

    public function userInformation()
    {
        return $this->hasOne('App\UserInformation');
    }

    public function followUsers()  // Auth::user()->followUsers で自分がfollowしているuserを全取得
    {
        return $this->belongsToMany(self::class, 'follow_users', 'user_id', 'followed_user_id')
            ->using(FollowUser::class);
    }

    public function followedUsers()  // Auth::user()->followedUsers で自分をfollowしているユーザーを全取得
    {
        return $this->belongsToMany(self::class, 'follow_users', 'followed_user_id', 'user_id')
            ->using(FollowUser::class);
    }

    public function isFollow(User $user)  // Auth::user()->isFollow($user) で自分が空いてをfollowしてればtrue
    {
        return $this->followUsers()->where('followed_user_id', '=', $user->id)->exists();
    }

    public function isFollowed()  // $user->isFollowed() で相手が自分をfollowしてればtrue
    {
        return $this->followUsers()->where('followed_user_id', '=', Auth::id())->exists();
    }

    public function isEachFollow(User $user)  // Auth::user()->isEachFollow($user); で相互followしていればtrue
    {
        if (Auth::user()->isFollow($user)) {
            return $user->isFollowed();
        } else {
            return false;
        }
    }

    public function followers()
    {
        $follow_users = $this->followUsers;
        $followed_users = $this->followedUsers;
        $follow_or_followed_users = $follow_users->concat($followed_users)->unique()->sortBy('name');
        return $follow_or_followed_users;
    }
}
