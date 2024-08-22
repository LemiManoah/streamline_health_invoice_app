<?php

namespace Modules\Client\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Client\Database\Factories\ClientFactory;

class Client extends Model
{
    use HasFactory;

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'facility_level',
        'location',
        'contact_person_name',
        'contact_person_phone',
        'email_for_invoices',
        'billing_cycle',
        'streamline_engineer_name',
        'streamline_engineer_phone',
        'streamline_engineer_email',
    ];

    protected $dates = ['deleted_at'];

    protected static function newFactory()
    {
        //return ClientFactory::new();
    }
}
