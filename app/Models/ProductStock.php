<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    protected $table = 'product_stock'; // Nombre exacto de tu tabla
    public $timestamps = true; // o false si no tienes created_at / updated_at
    use HasFactory;

    protected $fillable = ['product_id', 'movement_type', 'units', 'comment'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
