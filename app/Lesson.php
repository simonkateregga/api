<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['title', 'body', 'some_bool'];

    /**
     * Relationship to tags
     * @return mixed
     */
    public function tags() {
        return $this->belongsToMany('App\Tag');
    }
}
