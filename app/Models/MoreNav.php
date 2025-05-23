<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoreNav  extends Model
{
    use HasFactory;

    protected $table = 'more-nav'; // Table name

    protected $fillable = [
        'name',
        'name_url',
    ];
}
