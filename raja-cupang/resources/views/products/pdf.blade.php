<!DOCTYPE html>
<html>
<head>
    <title>{{ $product->name }}</title>
</head>
<body>
    <h1>{{ $product->name }}</h1>
    <p>{{ $product->description }}</p>
    <p>Harga: Rp{{ number_format($product->price, 0, ',', '.') }}</p>
    <p>Stok: {{ $product->stock }}</p>
</body>
</html>
