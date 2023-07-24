@extends('layouts.app')

@section('content')
<h1>Edit Stock</h1>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('stocks.update', $stock->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="category">Category:</label>
        <input type="text" name="category" id="category" class="form-control" value="{{ $stock->category }}" required>
    </div>
    <div class="form-group">
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" class="form-control" value="" required>
    </div>
    <div class="form-group">
        <label for="details">Details:</label>
        <textarea name="details" id="details" class="form-control">{{ $stock->details }}</textarea>
    </div>
    <div class="form-group">
        <label for="date_purchased">Date Purchased:</label>
        <input type="date" name="date_purchased" id="date_purchased" class="form-control" value="{{ $stock->date_purchased }}" required>
    </div>
    <div class="form-group">
        <label for="status">Status:</label>
        <select name="status" id="status" class="form-control" required>
            <option value="brandnew" @if($stock->status == 'brandnew') selected @endif>Brand New</option>
            <option value="used" @if($stock->status == 'used') selected @endif>Used</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('stocks.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection