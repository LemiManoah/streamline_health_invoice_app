<?php

namespace Modules\Client\Models;

use Modules\Invoice\Models\Invoice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Modules\Client\Database\Factories\ClientFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;
    use Notifiable;

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
        return ClientFactory::new();
    }
    public function routeNotificationForMail($notification)
    {
        // Return the email address you want to use for sending notifications
        return $this->client_email; 
    }
    public function invoice(){
        return $this->hasMany(Invoice::class);
    }
    public function subscriptions(){
        return $this->hasMany(Subscription::class);
    }
}