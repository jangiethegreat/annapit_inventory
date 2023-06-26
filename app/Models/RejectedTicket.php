<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RejectedTicket extends Model
{
    use HasFactory;
    protected $fillable = ['requestor_name', 'unit_no', 'items_requested', 'quantity', 'remarks'];
    public $timestamps = false;
}
