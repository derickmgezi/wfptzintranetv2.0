<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResourceCategory extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'resourcecategory';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category','position','status','created_by','edited_by','image',
    ];
}
