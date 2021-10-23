<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Hootlex\Moderation\Moderatable;

class Email extends Model
{
    use HasFactory, Moderatable;

    protected $fillable = ['id','title', 'description', 'status', 'user_id'];
}
