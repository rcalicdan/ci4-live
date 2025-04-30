<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Rcalicdan\Ci4Larabridge\Models\Model;

class Post extends EloquentModel
{
    protected $table = 'posts';
    protected $fillable = ['title', 'content', 'status'];
}