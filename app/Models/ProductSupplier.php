<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSupplier extends Model
{
    protected $table = 'product_suppliers'; // Nombre exacto de tu tabla
    public $timestamps = true; // o false si no tienes created_at / updated_at

    protected $fillable = [
        'product_id',
        'company_id',
        'sku',
        'currency_id',
        'price',
        'default',
        'availability',
        'availability_number'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
