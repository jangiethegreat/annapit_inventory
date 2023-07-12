@extends('layouts.app')

@section('content')
<h1>Accepted Requests</h1>

@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
<hr>

<div class="row">
    @forelse ($acceptedTickets as $acceptedTicket)
    <div class="col-md-4 mb-4">
        <div class="card text-center border-success mb-3" style="max-width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Requestor's Name: {{ $acceptedTicket->requestor_name }}</h5>
                <p class="card-text">Unit No: {{ $acceptedTicket->unit_no }}</p>
                <p class="card-text">Items Requested: {{ $acceptedTicket->items_requested }}</p>
                <p class="card-text">Quantity: {{ $acceptedTicket->quantity }}</p>
                <p class="card-text">Status: {{ $acceptedTicket->status }}</p>
                <p class="card-text">Remarks: {{ $acceptedTicket->remarks }}</p>
                @if ($acceptedTicket->status !== 'Accepted')
                <form action="{{ route('accepted_tickets.update', $acceptedTicket->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Add the necessary form fields here -->
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
                @endif
                @if ($acceptedTicket->status === 'Accepted')
                <form action="{{ route('accepted_tickets.deploy', $acceptedTicket->id) }}">
                    @csrf
                    <button class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i> View Stocks</button>
                </form>
                @endif
            </div>
        </div>
    </div>
    @empty
    <div class="col">
        <p>No accepted requests found.</p>
    </div>
    @endforelse
</div>

<style>
    .card {
        box-shadow: 5px 5px 3px 6px lightgray;
    }
</style>
@endsection