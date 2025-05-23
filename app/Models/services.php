<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class services extends Model
{
    use HasFactory;

    protected $table = 'services'; // Table name

    protected $fillable = [
        'background_picture',
        'title1',
        'title1_content',
        'button1_name',
        'button1_url',
        'button2_name',
        'button2_url',
        'title2',
        'picture1',
        'title3',
        'title3_content'
    ];
}
