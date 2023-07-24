@extends('layouts.app')

@section('content')
<h1>Create Stock</h1>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('stocks.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="category">Category:</label>
        <select name="category" id="category" class="form-control" required>
            <option value="">Select Category</option>
            @foreach($categories as $categoryId => $categoryName)
            <option value="{{ $categoryId }}">{{ $categoryName }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="details">Details:</label>
        <textarea name="details" id="details" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="date_purchased">Date Purchased:</label>
        <input type="date" name="date_purchased" id="date_purchased" class="form-control">
    </div>
    <div class="form-group">
        <label for="status">Status:</label>
        <select name="status" id="status" class="form-control">
            <option value="brandnew">Brand New</option>
            <option value="used">Used</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
    <a href="{{ route('stocks.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection