<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResourceManager extends Model{
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'resourcemanagers';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user','resource_type_id','status','created_by','edited_by',
    ];
}
