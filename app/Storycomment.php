<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Storycomment extends Model {
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'story_id','comment','status','comment_by',
    ];
}
