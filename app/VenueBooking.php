<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VenueBooking extends Model{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'venuebookings';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'purpose','location','venue','date','start_time','end_time','participants','requirebeverages','beverageoptions','created_by','status',
    ];
}
