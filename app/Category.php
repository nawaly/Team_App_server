<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{
    protected $fillable=[
        'name', 'icon', 'color'
    ];
    protected $dates=[
        'deleted_at'
    ];

}
