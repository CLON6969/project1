<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomepageContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'background_picture', 'title1', 'title1_content', 'title2', 'title2_content', 'picture1'
    ];
}

