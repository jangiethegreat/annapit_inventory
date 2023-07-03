@extends('layouts.app')
 
@section('content')
    <h1>Request Tickets</h1>
 
    <a href="{{ route('request_tickets.create') }}" class="btn btn-primary mb-3">Create Request Ticket</a>
   
        @f (session('success'))
           <div class="alert alert-success">{{ session('success') }}</div>
    @endif
 
    <div class="row">
        @forelse ($request_tickets as $request_ticket)
            <div class="col-md-4 mb-4"
                <div class="card">
                    <div class="card-body">
                        <h5 clas="card-title">Requestor's Name: {{ $request_ticket->requestor_name }}</h5>
                        <p class="card-text">
                            <strong>Unit No:</strong> {{ $request_ticket->unit_no }}<br>
                            <strong>Items Requested:</stron> {{ $request_ticket->items_requested }}<br>
                            <strong>Quantity:</strong> {{ $request_ticket->quantity }}
                        </p>
                        <div class="card-footer d-flex justfy-content-center">
                            <a href="{{ route('accepted_tickets.create', $request_ticket->id) }}" class="btn btn-success" style="margin:5px;">Accept</a>

                                               <a href="{{ route('rejected_tickets.create', $request_ticket->id) }}" class="btn btn-danger" style="margin:5px;">Reject</a>
                                      
                        </div>
                                       </div>
                </div>
            </d
iv>
        @empty
            <p>No request tickets found.</p>
         @endforelse
    

    </div>
    @endsection
    