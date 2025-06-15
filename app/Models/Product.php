<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products'; // Nombre exacto de tu tabla
    public $timestamps = true; // o false si no tienes created_at / updated_at

    protected $fillable = [
        'sku',
        'product',
        'brand',
        'description',
        'family_id',
        'currency_id',
        'price',
        'image',
        'slug'
    ];

    public function family()
    {
        return $this->belongsTo(ProductFamily::class, 'family_id');
    }

    public function customValues()
    {
        return $this->hasMany(ProductCustomValue::class, 'product_id');
    }

    public function stocks()
    {
        return $this->hasMany(ProductStock::class, 'product_id');
    }

    public function suppliers()
    {
        return $this->hasMany(ProductSupplier::class, 'product_id');
    }

    public function productTaxes()
    {
        return $this->hasMany(ProductTax::class, 'product_id');
    }

    public function taxes()
    {
        return $this->belongsToMany(Tax::class, 'product_taxes', 'product_id', 'tax_id');
    }

    public function getRouteKeyName()
    {
        return 'slug'; // Usar slug en lugar de id en la URL
    }
}
