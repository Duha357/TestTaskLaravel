<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function users()
    {
        return $this->hasMany('App\User', 'article_user');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment', 'article_comment');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'article_tag');
    }
}
