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
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('stocks.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection