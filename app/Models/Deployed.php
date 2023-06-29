<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deployed extends Model
{
    use HasFactory;
    protected $fillable = [
        'requested_by',
        'unit_no',
        'item_requested',
        'quantity',
        'deployed_by',
        'date',
    ];
    public $timestamps = false;

}