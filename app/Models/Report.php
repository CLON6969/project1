<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'title',
        'description',
        'type',      // 'income', 'expense', or 'summary'
        'data',      // JSON snapshot of report data
    ];

    protected $casts = [
        'data' => 'array', // Automatically casts JSON to array
    ];
}
