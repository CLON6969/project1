<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pricing extends Model
{
    use HasFactory;

    protected $table = 'pricing'; // Table name

    protected $fillable = [
       
        'title1',
        'title2',
        'title2_content',
        'title3',
        'title4'
    ];
}