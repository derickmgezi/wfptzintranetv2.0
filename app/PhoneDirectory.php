<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class PhoneDirectory extends Model {
    
    use Searchable;
    
    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'phonedirectories';
    }
    
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
        'name', 'function', 'department', 'duty_station', 'ext_no', 'official_mobile_no', 'personal_mobile_no', 'status',
    ];
}
