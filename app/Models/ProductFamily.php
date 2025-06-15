<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFamily extends Model
{
    protected $table = 'product_families'; // Nombre exacto de tu tabla
    public $timestamps = true; // o false si no tienes created_at / updated_at
    use HasFactory;

    protected $fillable = ['family', 'slug', 'public'];

    public function products()
    {
        return $this->hasMany(Product::class, 'family_id');
    }

    public function customFields()
    {
        return $this->hasMany(ProductCustomField::class, 'family_id');
    }
}
