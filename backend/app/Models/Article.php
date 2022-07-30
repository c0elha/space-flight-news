<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    public $incrementing = false;

    protected $fillable = ['id', 'featured', 'title', 'url', 'imageUrl', 'newsSite', 'summary', 'publishedAt'];

    protected $hidden = ['_id', 'pivot', 'created_at', 'updated_at'];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'article_events');
    }

    public function launches()
    {
        return $this->belongsToMany(Launche::class, 'article_launches');
    }
}
