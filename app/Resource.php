<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model{

    use Searchable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'resources';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'resource_name','position','subfolder_id'.'status','resource_location','external_link','uploaded_by','edited_by','image',
    ];
}
