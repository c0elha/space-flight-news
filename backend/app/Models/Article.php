<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    public $incrementing = false;

    protected $fillable = ['id', 'featured', 'title', 'url', 'imageUrl', 'newsSite', 'summary', 'publishedAt'];

    protected $hidden = ['_id', 'created_at', 'updated_at'];

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    public function launches()
    {
        return $this->belongsToMany(Launche::class);
    }
}
