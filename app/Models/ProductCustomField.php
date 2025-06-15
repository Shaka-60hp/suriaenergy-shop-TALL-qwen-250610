<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCustomField extends Model
{
    protected $table = 'product_custom_fields'; // Nombre exacto de tu tabla
    public $timestamps = true; // o false si no tienes created_at / updated_at
    use HasFactory;

    protected $fillable = [
        'family_id',
        'custom_field_name',
        'custom_field_type',
        'custom_field_unit',
        'order'
    ];

    public function family()
    {
        return $this->belongsTo(ProductFamily::class, 'family_id');
    }

    public function values()
    {
        return $this->hasMany(ProductCustomValue::class, 'custom_field_id');
    }
}
