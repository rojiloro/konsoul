<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profileImg extends Model
{
    protected $fillable = ['user_id', 'path'];
}