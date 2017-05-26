<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'header','description','story','type','image','status','crated_by','edited_by',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

}
