<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    protected $table = 'taxes'; // Nombre exacto de tu tabla
    public $timestamps = true; // o false si no tienes created_at / updated_at

    /** @use HasFactory<\Database\Factories\TaxFactory> */
    use HasFactory;

    protected $fillable = ['tax_name', 'tax_amount'];

    public function productTaxes()
    {
        return $this->hasMany(ProductTax::class, 'tax_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_taxes', 'tax_id', 'product_id');
    }
}
