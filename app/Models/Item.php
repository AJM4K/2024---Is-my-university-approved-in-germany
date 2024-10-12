<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'quantity', 'description', 'location','in_quantity',   // New field
        'out_quantity'];

    public function movements()
    {
        return $this->hasMany(ItemsMovement::class);
    }
}
