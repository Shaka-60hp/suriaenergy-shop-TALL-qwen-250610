<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class UserController extends Controller
{
    // Dashboard de usuario
    public function index()
    {
        $user = Auth::user();
        $orders = Order::where('contact_id', $user->id)->latest()->paginate(10);

        return view('web.user.dashboard', compact('user', 'orders'));
    }
}
