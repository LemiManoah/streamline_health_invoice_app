<?php

namespace Modules\Invoice\Models;

use Modules\Client\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Invoice\Database\Factories\InvoiceFactory;

class Invoice extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected static function newFactory()
    {
        //return InvoiceFactory::new();
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
