<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class services_table extends Model
{
    use HasFactory;

    protected $table = 'services_table'; // Table name

    protected $fillable = [
        'icon',
        'title1',
        'title1_sub_content',
        'button1_name',
        'button1_url',
        'category'
    ];

    public function invoices()
{
    return $this->morphMany(Invoice::class, 'invoiceable');
}

}


