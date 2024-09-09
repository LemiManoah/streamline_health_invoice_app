<?php

namespace Modules\Client\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Client\Database\Factories\SubscriptionFactory;

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
        'billing_cycle',
        'start_date',
        'end_date',
        'amount',
        'status',
        'deleted_at',
    ];

    protected static function newFactory()
    {
        //return SubscriptionFactory::new();
    }
}
