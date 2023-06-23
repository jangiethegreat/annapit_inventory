@extends('layouts.app')

@section('content')
    <h1>Stock Details</h1>

    <div class="card">
        <div class="card-header">
            Category: {{ $stock->category }}
        </div>
        <div class="card-body">
            <p>Quantity: {{ $stock->quantity }}</p>
            <p>Details: {{ $stock->details }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('stocks.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
@endsection
