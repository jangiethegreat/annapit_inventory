@extends('layouts.app')

@section('content')
<h1>Rejected Tickets</h1>

@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
<hr>

<div class="row">
    @forelse ($rejectedTickets as $rejectedTicket)
    <div class="col-md-4 mb-4">
        <div class="card border-danger mb-3" style="max-width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Requestor's Name: {{ $rejectedTicket->requestor_name }}</h5>
                <p class="card-text">Unit No: {{ $rejectedTicket->unit_no }}</p>
                <p class="card-text">Items Requested: {{ $rejectedTicket->items_requested }}</p>
                <p class="card-text">Quantity: {{ $rejectedTicket->quantity }}</p>
                <p class="card-text">Remarks: {{ $rejectedTicket->remarks }}</p>
            </div>
        </div>
    </div>
    @empty
    <div class="col">
        <p>No rejected tickets found.</p>
    </div>
    @endforelse
</div>
<style>
    .card {
        box-shadow: 5px 5px 3px 6px lightblue;
    }
</style>
@endsection