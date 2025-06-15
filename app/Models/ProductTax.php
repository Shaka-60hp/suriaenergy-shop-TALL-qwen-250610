<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTax extends Model
{
    protected $table = 'product_taxes'; // Nombre exacto de tu tabla
    public $timestamps = true; // o false si no tienes created_at / updated_at
    use HasFactory;

    protected $fillable = ['product_id', 'tax_id'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function tax()
    {
        return $this->belongsTo(Tax::class, 'tax_id');
    }
}
