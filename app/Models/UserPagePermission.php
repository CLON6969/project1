<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserPagePermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'page',
        'can_view',
        'can_create',
        'can_update',
        'can_delete'
    ];

    protected $casts = [
        'can_view' => 'boolean',
        'can_create' => 'boolean',
        'can_update' => 'boolean',
        'can_delete' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
