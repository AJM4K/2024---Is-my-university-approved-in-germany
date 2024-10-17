<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemsMovement extends Model
{
    use HasFactory;

    protected $fillable = ['item_id', 'quantity', 'location','description',  // New field
        'status' , 'closed', // Add this line
         ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
