<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class more extends Model
{
    use HasFactory;

    protected $table = 'more'; // Table name

    protected $fillable = [
        'background_picture',
        'title1',
        'title1_content',
        'picture1',
        'title2',
        'title2_content',
        'button1_name',
        'button1_url',
        'button2_name',
        'button2_url'
    ];
}
