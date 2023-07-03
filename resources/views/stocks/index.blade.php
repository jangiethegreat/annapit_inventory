@extends('layouts.app')

@section('content')
    <h1>Stocks</h1>

    <a href="{{ route('stocks.create') }}" class="btn btn-primary mb-3">Add Stock</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Category</th>
                <th>Quantity</th>
                <th>Details</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($stocks as $stock)
                <tr>
                    <td>{{ $stock->category }}</td> <!-- Display the category name -->
                    <td>{{ $stock->quantity }}</td>
                    <td>{{ $stock->details }}</td>
                    <td>
                <form action="{{ route('stocks.addtocart', $stock->id) }}" method="POST">
                   
                    <button type="submit" class="btn btn-primary">Add to Cart</button>

                        <a href="{{ route('stocks.edit', $stock->id) }}" class="btn btn-secondary">Edit</a>
                        <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this stock?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No stocks found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
