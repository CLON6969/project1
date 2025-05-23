<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_type',
        'name',
        'username',
        'email',
        'password',
        'profile_picture',
        'account_status',
        'phone',
        'address',
        'city',
        'state',
        'postal_code',
        'country',
        'website',
        'organization_type',
        'industry',
        'company_registration_number',
        'tax_id',
        'organization_size',
        'two_factor_enabled',
        'email_verified',
        'id_document_path',
        'business_license_path',
        'bio',
        'referral_source',
        'parent_account_id',
        'account_type',
        'email_verified_at',
        'role_id',
        'profile_completed',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'two_factor_enabled' => 'boolean',
        'email_verified' => 'boolean',
        'profile_completed' => 'boolean',
    ];

    /**
     * Relationships
     */
    
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function parentAccount()
    {
        return $this->belongsTo(User::class, 'parent_account_id');
    }

    public function subAccounts()
    {
        return $this->hasMany(User::class, 'parent_account_id');
    }
}
