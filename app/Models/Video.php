<?php

namespace App\Models;


class Video extends Model
{
    protected $primaryKey='id';
    protected $fillable=['title','channel_id','description','path','percentage','thumbnail','duration','views','created_at','updated_at'];
    public $timestamps = true;
    public function channel(){
        return $this->belongsTo(Channel::class,'channel_id','id');
    }
    public function comments(){
        //first, the current model field, and then the field of the model being joined
        return $this->hasMany(Comment::class,'video_id','id');
    }
}

