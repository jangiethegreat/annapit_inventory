@extends('layouts.app')

@section('content')
    <h1>Rejected Tickets</h1>

  

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Requestor's Name</th>
                <th>Unit No</th>
                <th>Items Requested</th>
                <th>Quantity</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($rejectedTickets as $rejectedTicket)
                <tr>
                    <td>{{ $rejectedTicket->requestor_name }}</td>
                    <td>{{ $rejectedTicket->unit_no }}</td>
                    <td>{{ $rejectedTicket->items_requested }}</td>
                    <td>{{ $rejectedTicket->quantity }}</td>
                    <td>{{ $rejectedTicket->remarks }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No rejected tickets found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
