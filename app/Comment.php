<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['body','post_id','user_id'];

    public function comment(){
        return $this->belongsTo('App\Post');
    }
    public function userComment(){
        return $this->belongsTo('App\User');
    }
}
