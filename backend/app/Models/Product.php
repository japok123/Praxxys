<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['created_at'];

    public function images()
{
    return $this->hasMany(ProductFIles::class,'product_id');
}
}
