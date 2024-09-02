<?php

namespace Modules\Client\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Client\Database\Factories\ClientFactory;

class Client extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'facility_level',
        'location',
        'client_email',
        'contact_person_name',
        'contact_person_phone',
        'billing_cycle_in_years',
        'streamline_engineer_name',
        'streamline_engineer_phone',
        'streamline_engineer_email',
        'email_verified_at', 
        'verification_token',
        'verification_status',
        
    ];

    // Cast 'email_verified_at' to datetime
    protected $casts = [
        'email_verified_at' => 'datetime', 
    ];

    public function hasVerifiedEmail(): bool
    {
        return !is_null($this->email_verified_at);
    }

    protected static function newFactory()
    {
        //return ClientModelFactory::new();
    }
}
