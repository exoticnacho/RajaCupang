@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h4>Riwayat Transaksi Saya</h4>

  @forelse ($orders as $order)
    <div class="card mb-3">
      <div class="card-header d-flex justify-content-between">
        <span>Pesanan #{{ $order->id }} ({{ $order->status }})</span>
        <span>Total: Rp{{ number_format($order->total) }}</span>
      </div>
      <div class="card-body">
        <ul class="list-group">
          @foreach ($order->items as $item)
            <li class="list-group-item d-flex justify-content-between">
              <span>{{ $item->product->name }} (x{{ $item->quantity }})</span>
              <span>Rp{{ number_format($item->price * $item->quantity) }}</span>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  @empty
    <p>Kamu belum pernah melakukan transaksi.</p>
  @endforelse
</div>
@endsection
