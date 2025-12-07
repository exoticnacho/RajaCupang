@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Detail produk -->
    <h2>{{ $product->name }}</h2>
    <p>{{ $product->description }}</p>
    <p>Harga: Rp{{ number_format($product->price) }}</p>

    <!-- Form review -->
    @auth
        @php
            // Ambil review user yang sudah ada untuk produk ini (jika ada)
            $userReview = auth()->user()->reviews->where('product_id', $product->id)->first();
        @endphp

        <h4>Tambah/Ubah Review Anda</h4>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form action="{{ route('products.review', $product) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="rating" class="form-label">Rating (1-5):</label>
                <select name="rating" id="rating" class="form-select" required>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ ($userReview && $userReview->rating == $i) ? 'selected' : '' }}>
                            {{ $i }}
                        </option>
                    @endfor
                </select>
                @error('rating')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="comment" class="form-label">Komentar:</label>
                <textarea name="comment" id="comment" class="form-control" rows="3">{{ $userReview ? $userReview->comment : '' }}</textarea>
                @error('comment')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Kirim Review</button>
        </form>
    @else
        <p><a href="{{ route('login') }}">Login</a> untuk memberikan review.</p>
    @endauth

    <!-- List semua review produk -->
    <h4 class="mt-5">Ulasan Produk</h4>
    @forelse($product->reviews()->with('user')->latest()->get() as $review)
        <div class="border p-3 mb-3">
            <strong>{{ $review->user->name }}</strong> - Rating: {{ $review->rating }} / 5
            <p>{{ $review->comment }}</p>
            <small class="text-muted">Ditulis pada {{ $review->created_at->format('d M Y') }}</small>
        </div>
    @empty
        <p>Belum ada ulasan untuk produk ini.</p>
    @endforelse

    <p class="card-text">Stok: {{ $product->stock }}</p>

    @if($product->stock > 0)
    <a 
        href="https://wa.me/{{ env('WA_ADMIN') }}?text=Halo%20Raja%20Cupang,%20saya%20mau%20pesan:%0A- {{ $product->name }} | Rp{{ number_format($product->price) }}%0AQty: 1"
        class="btn btn-success mt-3"
        target="_blank"
    >
        <i class="fab fa-whatsapp"></i> Pesan Sekarang
    </a>
    @else
    <span class="badge bg-danger">Stok Habis</span>
    @endif

</div>
@endsection