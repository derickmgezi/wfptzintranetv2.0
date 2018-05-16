<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Story extends Model {
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'stories';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'caption','image','status','posted_by',
    ];
}
