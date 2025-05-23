<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventTable extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'events_table';

    // Define the fillable fields (columns that can be mass-assigned)
    protected $fillable = [
        'picture',
        'title1',
        'title1_content',
        'country',
        'town',
        'main_tittle',
        'main_tittle_content',
        'day',
        'date',
        'start_time',
        'end_time',
        'button1_name',
        'button1_url',
    ];

    // Define any relationships if applicable (e.g., one-to-many, many-to-many, etc.)
    // Example: 
    // public function relatedModel()
    // {
    //     return $this->hasMany(RelatedModel::class);
    // }
}
