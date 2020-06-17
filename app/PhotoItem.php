<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhotoItem extends Model
{
    protected $fillable =[
        'name',
        'image',
        'user_id',
    ];
}
