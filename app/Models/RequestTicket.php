<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestTicket extends Model
{
    use HasFactory;
    protected $fillable = ['requestor_name', 'items_requested', 'quantity'];
    public $timestamps = false;

}