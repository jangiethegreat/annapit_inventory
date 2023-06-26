<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcceptedTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'requestor_name',
        'items_requested',
        'unit_no',
        'quantity',
        'status',
        'remarks',
    ];

    public $timestamps = false;
}
