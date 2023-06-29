@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Cart</h1>
        @if (count($cartItems) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartItems as $cartItem)
                        <tr>
                            <td>{{ $cartItem->stock->category }}</td>
                            <td>{{ $cartItem->quantity }}</td>
                            <td>
                            
                            <a href="{{ route('cart.remove', $cartItem->id) }}"><button type="submit" class="btn btn-danger">Remove</button></a>
                                    
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
           
                @csrf
                <a href="{{ url('/cart/clear') }}"><button type="submit" class="btn btn-warning">Clear Cart</button></a>
                <a href="#"><button type="submit" class="btn btn-success">Deploy</button></a>
            </form>
        @else
            <p>Your cart is empty.</p>
        @endif
    </div>
@endsection
