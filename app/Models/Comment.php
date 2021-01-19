<?php

namespace App\Models;


class Comment extends Model
{
    protected $fillable = ['user_id','video_id','text'];
    public $timestamps = true;
    //every time you load this comment you get with user relation !
    protected $with=['user'];
    public function user(){
        return $this->belongsTo(User::class,'user_id','id')->select('id','name');
    }
}
