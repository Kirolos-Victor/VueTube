<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Support\Str;

class Model extends BaseModel
{
    //turn off incrementing id in database table and change it to UUID( Universal unique identifier )
    public $incrementing = false;
    protected $primaryKey = 'id';

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }

}
