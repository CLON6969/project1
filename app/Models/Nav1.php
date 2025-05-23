<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nav1 extends Model
{
    use HasFactory;

    protected $table = 'nav1';

    protected $fillable = ['name', 'name_url'];
}
