<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleEvent extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['article_id', 'event_id'];
}
