<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class delivery1Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'delivery1_id',
        'delivered_quantity',
        'subTotal',
        
    ];

    public function delivery1() {
        return $this->hasmany(delivery1Products::class);
    }

}
