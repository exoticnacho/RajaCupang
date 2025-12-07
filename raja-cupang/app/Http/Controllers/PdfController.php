<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function exportPdf($id)
    {
        $product = Product::findOrFail($id);
        $pdf = Pdf::loadView('pdf.product', compact('product'));
        return $pdf->download('product-' . $product->id . '.pdf');
    }
}
