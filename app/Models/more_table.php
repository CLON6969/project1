<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class more_table extends Model
{
    use HasFactory;

    protected $table = 'more_table'; // Table name

    protected $fillable = [
        'icon',
        'title1',
        'title1_sub_content',
        'title2',
        'title2_content',
        'title2_sub_content',
        'button1_name',
        'button1_url'
    ];
}
