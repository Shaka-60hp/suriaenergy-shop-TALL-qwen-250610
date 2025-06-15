<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public $timestamps = true; // o false si no tienes created_at / updated_at
    /** @use HasFactory<\Database\Factories\CompanyFactory> */
    use HasFactory;

    protected $table = 'companies';

    protected $fillable = ['name', 'avatar', 'phone', 'location_id'];
}
