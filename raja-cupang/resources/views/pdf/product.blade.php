<!-- resources/views/pdf/product.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Detail Produk</title>
    <style>
        body { font-family: sans-serif; }
        .container { padding: 20px; }
        .product-img { width: 200px; height: auto; }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ $product->name }}</h1>
        <p><strong>Harga:</strong> Rp{{ number_format($product->price, 0, ',', '.') }}</p>
        <p><strong>Stok:</strong> {{ $product->stock }}</p>
        <p><strong>Kategori:</strong> {{ $product->category->name ?? '-' }}</p>
        <p><strong>Deskripsi:</strong> {{ $product->description }}</p>
        @if($product->image)
            <img src="{{ public_path('storage/' . $product->image) }}" class="product-img" alt="Gambar Produk">
        @endif
    </div>
</body>
</html>
