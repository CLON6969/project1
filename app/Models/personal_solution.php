<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class personal_solution extends Model
{
    use HasFactory;

    protected $table = 'personal_solutions'; // Table name

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
        'title3_content',
        'button3_name',
        'button3_url'
    ];
}
