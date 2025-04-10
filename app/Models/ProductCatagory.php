<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCatagory extends Model
{
    use HasFactory;
    protected $fillable = [
        'catagoryName',
        'category_image',
        'description',

    ];
    public $table = "product_catagories";
    public $timestamp = true;

}
