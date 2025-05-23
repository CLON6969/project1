<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_tittle', 'statement', 'tittle1', 'tittle1_content',
        'tittle2', 'tittle2_content', 'tittle3', 'tittle3_content',
        'tittle4', 'tittle4_content', 'tittle5', 'tittle5_content'
    ];

    public function plans()
    {
        return $this->hasMany(Plan::class);
    }
}
