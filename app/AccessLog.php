<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccessLog extends Model{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'access_logs';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'action_by','link_accessed','action_taken','action_details','action_status','link_type',
    ];
    
}
