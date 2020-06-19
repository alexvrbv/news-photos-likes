<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable =[
        'item_id',
        'item_type',
        'user_id',
    ];
}
