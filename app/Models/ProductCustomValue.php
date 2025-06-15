<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCustomValue extends Model
{
    protected $table = 'product_custom_values'; // Nombre exacto de tu tabla
    public $timestamps = true; // o false si no tienes created_at / updated_at
    use HasFactory;

    protected $fillable = [
        'product_id',
        'custom_field_id',
        'custom_field_value',
        'custom_field_json_value'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function field()
    {
        return $this->belongsTo(ProductCustomField::class, 'custom_field_id');
    }
}
