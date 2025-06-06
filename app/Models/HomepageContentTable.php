<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomepageContentTable extends Model
{
    use HasFactory;

    protected $fillable = [
        'url_name', 'url', 'picture'
    ];
}

