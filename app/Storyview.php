<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Storyview extends Model {
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'story_id','viewed_by',
    ];
}
