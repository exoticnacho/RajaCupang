<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // Toggle wishlist: tambahkan jika belum ada, hapus jika sudah ada
    public function toggle(Product $product)
    {
        $user = Auth::user();

        if ($user->wishlist()->where('product_id', $product->id)->exists()) {
            $user->wishlist()->detach($product->id);
        } else {
            $user->wishlist()->attach($product->id);
        }

        return back()->with('status', 'Wishlist diperbarui.');
    }

    // Tampilkan daftar produk di wishlist user
    public function index()
    {
        $products = Auth::user()->wishlist()->get();
        return view('wishlist.index', compact('products'));
    }

}
