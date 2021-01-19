<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable ;

//turn off incrementing id in database table and change it to UUID( Universal unique identifier )
    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();

        static::creating(function($model){
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }

    protected $fillable = [
        'name', 'email', 'password',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function channel(){
        return $this->hasOne(Channel::class,'user_id','id');
    }
    //both are for the same relation and connected to the same pivot table subscribers
    public function subscribers()
    {
        return $this->hasMany(Subscription::class);
    }

    public function toggleSubscribe()
    {
        return $this->belongsToMany(Channel::class,'subscriptions');
    }
    public function comments(){
        return $this->hasMany(Comment::class,'user_id','id')->orderByDesc('created_at');

    }

}
