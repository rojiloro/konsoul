<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavouritePost extends Model
{
    protected $fillable = ['user_id','post_id'];
}