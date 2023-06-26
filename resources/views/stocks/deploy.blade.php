@extends('layouts.app')

@section('content')
    <h1>Deploy Stocks</h1>

    @if ($stocks->isEmpty())
        <div class="alert alert-warning">No stocks available for deployment.</div>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stocks as $stock)
                    <tr>
                        <td>{{ $stock->category }}</td>
                        <td>{{ $stock->quantity }}</td>
                        <td>{{ $stock->details }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('accepted_tickets.index') }}" class="btn btn-secondary">Back</a>
@endsection
