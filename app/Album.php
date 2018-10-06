<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    //
    protected $fillable = [
        'name','info','user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function image()
    {
        return $this->hasMany('App\Image');
    }
}
