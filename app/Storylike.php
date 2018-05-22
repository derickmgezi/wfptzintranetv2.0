<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Storylike extends Model {
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'story_id','liked_by',
    ];
}
