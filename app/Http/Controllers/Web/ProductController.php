<?php

namespace App\Http\Controllers\Web;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ProductCustomValue;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(12);
        return view('web.products.index', compact('products'));
    }

    public function topSelling()
    {
        return view('web.products.top-selling');
    }

    public function onSale()
    {
        return view('web.products.sales');
    }

    public function newProducts()
    {
        return view('web.products.new');
    }

    public function show(Product $product)
    {
        // Obtener atributos personalizados
        $customValues = $product->customValues->keyBy('field.custom_field_name');

        $customFields = [];

        foreach ($customValues as $key => $value) {
            $customFields[$key] = $value->custom_field_value ?: json_decode($value->custom_field_json_value, true);
        }

        return view('web.products.show', compact('product', 'customFields'));
    }
}
