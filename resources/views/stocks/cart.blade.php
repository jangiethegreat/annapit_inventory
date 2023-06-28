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
                            
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
           
                @csrf
                <button type="submit" class="btn btn-warning">Clear Cart</button>
            </form>
        @else
            <p>Your cart is empty.</p>
        @endif
    </div>
@endsection
