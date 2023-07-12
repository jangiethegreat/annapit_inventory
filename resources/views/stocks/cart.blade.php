@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Cart</h1>
    <hr>
    @if (count($cartItems) > 0)
    <div class="row">
        @foreach ($cartItems as $cartItem)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $cartItem->stock->category }}</h5>
                    <p class="card-text">
                        Quantity: {{ $cartItem->quantity }}
                    </p>
                </div>
                <div class="card-footer">
                    <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Remove</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-12">
            <form action="{{ url('/cart/clear') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-warning">Clear Cart</button>
                <a href="#" class="btn btn-success">Deploy</a>
            </form>
        </div>
    </div>
    @else
    <p>Your cart is empty.</p>
    @endif
</div>
@endsection