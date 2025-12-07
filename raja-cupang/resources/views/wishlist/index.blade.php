@extends('layouts.app')

@section('content')
@if(session('status'))
  <div class="alert alert-success">
    {{ session('status') }}
  </div>
@endif
<div class="container py-4">
  <h4>Wishlist Saya</h4>
  <div class="row">
    @forelse ($products as $product)
      <div class="col-md-4 mb-3">
        <div class="card h-100">
          <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
          <div class="card-body d-flex flex-column">
            <h5>{{ $product->name }}</h5>
            <p>Rp {{ number_format($product->price) }}</p>

            <a href="{{ route('product.show', $product) }}" class="btn btn-sm btn-outline-primary mb-2 w-100">
              Lihat Detail
            </a>

            <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST" class="mt-auto">
              @csrf
              <button class="btn btn-sm btn-danger w-100">Hapus dari Wishlist</button>
            </form>
          </div>
        </div>
      </div>
    @empty
      <p>Kamu belum menambahkan produk ke wishlist.</p>
    @endforelse
  </div>
</div>
@endsection
