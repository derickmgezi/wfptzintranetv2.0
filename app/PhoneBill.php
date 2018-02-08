<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhoneBill extends Model {

    //use Searchable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'phonebills';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ext_no', 'user_name', 'line', 'type', 'number', 'date_time', 'duration', 'cost',
    ];

}
