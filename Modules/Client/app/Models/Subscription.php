<?php

namespace Modules\Client\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Client\Database\Factories\SubscriptionFactory;
use Modules\Client\Database\Factories\SubscriptionsFactory;

class Subscription extends Model
{
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'client_id',
        'plan_name',
        'billing_cycle_in_years',
        'start_date',
        'next_billing_date',
        'amount',
        'status',
        'deleted_at',
    ];

    protected static function newFactory()
    {
        return SubscriptionsFactory::new();
    }
    // Get the client associated with the subscription
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
