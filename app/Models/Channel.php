<?php

namespace App\Models;


use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use App\Models\Video;
class Channel extends Model implements HasMedia
{
    use HasMediaTrait;
    protected $primaryKey = 'id';
    protected $fillable=['name','user_id','description'];
    public $timestamps;

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
//    public function registerMediaConversions(Media $media = null)
//    {
//        $this->addMediaConversion('thumb');
//    }

    public function image(){
       if($this->media->last())
       {
           return $this->getFirstMediaUrl('channel_image');
       }
       return null;

    }
    public function editable()
    {
        if(Auth()->check())
        {
            return $this->user_id === Auth()->user()->id;
        }
        return false;
    }
    public function subscribers()
    {
     return $this->hasMany(Subscription::class);
    }
    // videos
    public function videos(){
        return$this->hasMany(Video::class,'channel_id','id');
    }
}
