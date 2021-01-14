<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResourceType extends Model{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'resourcetypes';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'resource_type','position','category_id','status','created_by','edited_by','image',
    ];
}
