<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Run extends Model
{
    protected $fillable = ['user_id', 'distance', 'run_date', 'image_path'];
}