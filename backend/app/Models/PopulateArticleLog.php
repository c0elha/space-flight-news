<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class PopulateArticleLog extends Model
{
    use HasFactory;

    protected $fillable = ['article_id', 'code', 'status'];
}
