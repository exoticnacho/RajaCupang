<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()->with('category');

        // Filter kategori
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('name', $request->category);
            });
        }

        // Urutkan harga
        if ($request->sort == 'termurah') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort == 'termahal') {
            $query->orderBy('price', 'desc');
        }

        $products = $query->paginate(8);
        $categories = Category::all();

        return view('home', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
    $product->load('reviews.user');
        return view('product-detail', compact('product'));
    }

    public function exportPdf(Product $product)
    {
        $pdf = Pdf::loadView('pdf.product', compact('product'));
        return $pdf->download("produk-{$product->name}.pdf");
    }

}
