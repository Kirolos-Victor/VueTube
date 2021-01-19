<?php

namespace App\Models;

class Subscription extends Model
// the error was YOU MUST REMOVE Illuminate\Database\Eloquent\Model and extend the model you made IMPORTANT
{
    protected $primaryKey='id';
    protected $fillable=['id','user_id','channel_id'];
    public $timestamps;


}
