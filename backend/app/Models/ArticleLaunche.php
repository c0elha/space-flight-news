<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class ArticleLaunche extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['article_id', 'launche_id'];
}
