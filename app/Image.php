<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'description','positive_vote','negative_vote','user_id'
    ];
}
