<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolutionTable extends Model
{
    use HasFactory;

    protected $table = 'solution_tables'; // Table name

    protected $fillable = [
        'icon',
        'title1',
        'title1_sub_content',
        'button1_name',
        'button1_url',
        'category'
    ];
}
