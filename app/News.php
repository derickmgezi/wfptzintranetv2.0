<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model {
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'header','description','story','source','type','image','status','crated_by','edited_by',
    ];
}
