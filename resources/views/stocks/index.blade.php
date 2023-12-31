@extends('layouts.app')

@section('content')
<h1>Stocks</h1>

<a href="{{ route('stocks.create') }}" class="btn btn-primary mb-3"> <i class="fa fa-plus-square-o" aria-hidden="true"></i> Add Stock</a>
<hr>
@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
<div style="margin:5px;">
    <form action="{{ route('stocks.index') }}" method="GET">
        <label>Show All Stocks:</label>
        <input type="checkbox" name="show_all" id="show_all" {{ $showAll ? 'checked' : '' }}>
        <button type="submit" class="btn btn-success">Apply Filter</button>
    </form>
</div>

<div style="margin:5px;">
    <form action="{{ route('stocks.index') }}" method="GET">
        <label for="category">Filter by Category:</label>
        <select name="category" id="category">
            <option value="all" {{ $categoryFilter === 'all' ? 'selected' : '' }}>All Categories</option>
            @foreach ($categories as $category)
            <option value="{{ $category->name }}" {{ $category->name === $categoryFilter ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Apply Filter</button>
    </form>
</div>
<div class="row">
    @forelse ($stocks as $stock)
    <div class="col-md-4 mb-4">
        <div class="card  text-center border-secondary mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $stock->category }}</h5>
                <p class="card-text">Quantity: {{ $stock->quantity }}</p>
                <p class="card-text">Details: {{ $stock->details }}</p>
                <p class="card-text">Date Purchased: {{ $stock->date_purchased }}</p>
                <p class="card-text">Condition: {{ $stock->status }}</p>
                <div class="card-footer d-flex justify-content-center">
                    <!-- <form action="{{ route('stocks.addtocart', $stock->id) }}" method="POST">
                        <button type="submit" class="btn btn-primary" style="display: inline-block; margin:5px;">Add to Cart</button>
                    </form> -->
                    <a href="{{ route('stocks.edit', $stock->id) }}" class="btn btn-secondary" style="display: inline-block; margin:5px;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST" style="display: inline-block; margin:5px;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this stock?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col">
        <p>No stocks found.</p>
    </div>
    @endforelse
</div>
<style>
    .card {
        box-shadow: 5px 5px 3px 6px lightgray;
    }
</style>
@endsection