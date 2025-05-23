<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'plan_tittle', 'amount', 'currency', 'content1',
        'titttle1', 'button1_name', 'button1_url',
        'button2_name', 'button2_url', 'package_id'
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function features()
    {
        return $this->hasMany(Feature::class);
    }

    public function plans()
{
    return $this->hasMany(Plan::class);
}

}
