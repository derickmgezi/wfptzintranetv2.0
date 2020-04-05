<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResourceManager extends Model{
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'resource_managers';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user','resource_type','status','created_by','edited_by',
    ];
}
