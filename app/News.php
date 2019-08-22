<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable=[
        'cover','title','category','slag','avatar','author','comments','isHot','time','tag',
        'paragraphs','media','adverts'
    ];
    protected $dates=[
        'deleted_at'
    ];
}
