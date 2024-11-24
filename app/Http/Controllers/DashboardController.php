<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data produk
        $products = Product::all();

        // Kirim data ke view dashboard
        return view('dashboard', compact('products'));
    }
}
