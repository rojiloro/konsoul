<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumniWork extends Model
{
    protected $fillable = ['user_id', 'post' ,'place', 'city', 'description', 'start_at','state', 'end_at'];
}