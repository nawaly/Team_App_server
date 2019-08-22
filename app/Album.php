<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Album extends Model
{
    use SoftDeletes;
    protected $fillable=[ //can be edited
        'title', 'subtitle', 'cover','avatar','isHot','details','author_id'
    ];
    protected $dates=[
        'deleted_at'
    ];
    public function author(){
        return $this->belongsTo(Author::class); //Album belongs to 1 author function
    }

}
