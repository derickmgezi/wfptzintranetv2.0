<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Story extends Model {

    use Searchable;

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
