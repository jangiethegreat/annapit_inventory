@extends('layouts.app')

@section('content')
    <h1>Create Request Ticket</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('request_tickets.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="requestor_name">Requestor's Name:</label>
            <input type="text" name="requestor_name" id="requestor_name" class="form-control" required>
        </div>
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
        <button type="submit" class="btn btn-primary">Create</button>
        <a href="{{ route('request_tickets.index') }}" class="btn btn-secondary">Back</a>
    </form>
@endsection
