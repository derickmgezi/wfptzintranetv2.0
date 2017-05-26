<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhoneDirectory extends Model {
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'phonedirectories';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'function', 'department', 'ext_no', 'number', 'location',
    ];
}
