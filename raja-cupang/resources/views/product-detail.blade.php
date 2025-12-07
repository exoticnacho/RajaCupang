@extends('layouts.app')

@section('content')
<div class="container mt-4 mb-5">
  <div class="row">
    <div class="col-md-5">
      @if ($product->image)
        <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded" alt="{{ $product->name }}">
      @else
        <div class="text-muted">Gambar tidak tersedia</div>
      @endif
    </div>
    <div class="col-md-7">
      <h2>{{ $product->name }}</h2>

      <p>
        <strong>Harga:</strong>
        Rp{{ number_format($product->price ?? 0, 0, ',', '.') }}
      </p>

      <p>
        <strong>Stok:</strong>
        {{ $product->stock ?? '0' }}
      </p>

      <p>{{ $product->description ?? 'Tidak ada deskripsi.' }}</p>

      @if(($product->stock ?? 0) > 0)
        <a 
          href="https://wa.me/62895321002181?text=Halo%20admin,%20saya%20ingin%20order%20ikan%20{{ urlencode($product->name) }}"
          class="btn btn-success mt-3"
          target="_blank"
        >
          <i class="fab fa-whatsapp"></i> Pesan via WhatsApp
        </a>
      @else
        <div class="mt-3">
          <span class="badge bg-danger">Stok Habis</span>
        </div>
      @endif
    </div>
  </div>

  {{-- Review Section --}}
  <div class="mt-5">
    <h4>Review Pengguna</h4>

    {{-- Form Review --}}
    @auth
      <form action="{{ route('review.store', $product->id) }}" method="POST" class="mb-4">
        @csrf
        <div class="mb-3">
          <label for="rating" class="form-label">Rating (1-5)</label>
          <input type="number" name="rating" id="rating" class="form-control" min="1" max="5" required value="{{ old('rating') }}">
        </div>
        <div class="mb-3">
          <label for="comment" class="form-label">Komentar</label>
          <textarea name="comment" id="comment" rows="3" class="form-control">{{ old('comment') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Review</button>
      </form>
    @endauth

    {{-- List Review --}}
    @if ($product->reviews->count())
      @foreach ($product->reviews as $review)
        <div class="border rounded p-3 mb-2">
          <strong>{{ $review->user->name }}</strong> —
          <span class="text-warning">
            @for ($i = 0; $i < $review->rating; $i++)
              ★
            @endfor
          </span>
          <p class="mb-0">{{ $review->comment }}</p>
        </div>
      @endforeach
    @else
      <p class="text-muted">Belum ada review untuk produk ini.</p>
    @endif
  </div>
</div>
@endsection
