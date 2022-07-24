<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class PopulateArticleCallLog extends Model
{
    use HasFactory;

    protected $fillable = ['limit', 'start_with', 'last_id'];
}
