@extends('layouts.app')

@section('content')
<h1>Deploy Accepted Ticket</h1>

<h2>Accepted Ticket Information:</h2>
<p><strong>Requestor's Name:</strong> {{ $acceptedTicket->requestor_name }}</p>
<p><strong>Unit No:</strong> {{ $acceptedTicket->unit_no }}</p>
<p><strong>Items Requested:</strong> {{ $acceptedTicket->items_requested }}</p>
<p><strong>Quantity:</strong> {{ $acceptedTicket->quantity }}</p>
<p><strong>Status:</strong> {{ $acceptedTicket->status }}</p>
<p><strong>Remarks:</strong> {{ $acceptedTicket->remarks }}</p>
@if (Session::get('item_added_to_cart'))
<a href="{{ route('deployeds.create') }}"><button type="button" class="btn btn-success"><i class="fa fa-share-square" aria-hidden="true"></i> Deploy</button></a>
@php
Session::forget('item_added_to_cart');
@endphp
@endif

@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<h2>Available Stocks:</h2>
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
        @if ($stock->quantity > 1)
        <tr>
            <td>{{ $stock->category }}</td>
            <td>{{ $stock->quantity }}</td>
            <td>{{ $stock->details }}</td>
            <td>
                <form action="{{ route('stocks.addtocart', $stock->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="number" name="quantity" class="form-control" value="0" min="1" max="{{ $stock->quantity }}">
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i> Add</button>
                </form>
            </td>
        </tr>
        @endif
        @empty
        <tr>
            <td colspan="3">No stocks available for the requested category.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection