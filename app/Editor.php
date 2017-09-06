<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Editor extends Model {
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'editor','function','status',
    ];
}
