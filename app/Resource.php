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
        'resource_name','resource_type','position','status','resource_location','external_link','uploaded_by','edited_by',
    ];
}
