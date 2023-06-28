<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['stock_id', 'quantity'];
    public $timestamps = false;

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
}