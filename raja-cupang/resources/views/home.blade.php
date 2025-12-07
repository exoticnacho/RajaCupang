@extends('layouts.app')

@section('content')
<style>
  .card-img-top {
    height: 200px;
    object-fit: cover;
  }
</style>

<div class="container mt-4">
  <h2 class="mb-4">Katalog Ikan Cupang</h2>

  <form method="GET" class="mb-4">
    <div class="row">
      <div class="col-md-4">
        <select name="category" class="form-select">
          <option value="">Semua Jenis</option>
          @foreach ($categories as $cat)
            <option value="{{ $cat->name }}" {{ request('category') == $cat->name ? 'selected' : '' }}>
              {{ $cat->name }}
            </option>
          @endforeach
        </select>
      </div>
      <div class="col-md-4">
        <select name="sort" class="form-select">
          <option value="">Urutkan Harga</option>
          <option value="termurah" {{ request('sort') == 'termurah' ? 'selected' : '' }}>Termurah</option>
          <option value="termahal" {{ request('sort') == 'termahal' ? 'selected' : '' }}>Termahal</option>
        </select>
      </div>
      <div class="col-md-4">
        <button class="btn btn-primary w-100">Filter</button>
      </div>
    </div>
  </form>

  <div class="row">
    @forelse($products as $product)
      <div class="col-md-3 mb-4">
        <div class="card h-100 d-flex flex-column">
          <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">{{ $product->name }}</h5>
            <p class="card-text">Rp{{ number_format($product->price) }}</p>

            @if($product->stock > 0)
              <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-primary mb-2 mt-auto w-100">
                Lihat Detail
              </a>
            @else
              <span class="badge bg-danger mb-2 mt-auto text-center w-100">Stok Habis</span>
            @endif

            @auth
              <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST">
                @csrf
                <button class="btn btn-outline-danger btn-sm w-100" type="submit">
                  <i class="fa{{ auth()->user()->wishlist->contains($product->id) ? 's' : 'r' }} fa-heart"></i>
                  {{ auth()->user()->wishlist->contains($product->id) ? 'Hapus dari Wishlist' : 'Tambah ke Wishlist' }}
                </button>
              </form>
            @endauth

          </div>
        </div>
      </div>
    @empty
      <p class="text-center">Produk tidak ditemukan.</p>
    @endforelse
  </div>

  <div class="d-flex justify-content-center mt-4">
    {{ $products->withQueryString()->links() }}
  </div>
</div>
@endsection
