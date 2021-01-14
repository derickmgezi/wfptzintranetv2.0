<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResourceSubfolder extends Model{
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'resourcesubfolders';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'resource_type_id','subfolder_name','position','status','created_by','edited_by','image',
    ];
}
