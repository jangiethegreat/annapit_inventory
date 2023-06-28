@extends('layouts.app')

@section('content')
    <h1>Accepted Requests</h1>

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
                <th>Status</th>
                <th>Remarks</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($acceptedTickets as $acceptedTicket)
                <tr>
                    <td>{{ $acceptedTicket->requestor_name }}</td>
                    <td>{{ $acceptedTicket->unit_no }}</td>
                    <td>{{ $acceptedTicket->items_requested }}</td>
                    <td>{{ $acceptedTicket->quantity }}</td>
                    <td>{{ $acceptedTicket->status }}</td>
                    <td>{{ $acceptedTicket->remarks }}</td>
                    <td>
                        @if ($acceptedTicket->status !== 'Accepted')
                            <form action="{{ route('accepted_tickets.update', $acceptedTicket->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <!-- Add the necessary form fields here -->
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        @endif
                    </td>
                    <td>
    @if ($acceptedTicket->status === 'Accepted')
        <form action="{{ route('accepted_tickets.deploy', $acceptedTicket->id) }}" >
            @csrf
            <button class="btn btn-primary">Deploy</button>
        </form>
    @endif
</td>

                </tr>
            @empty
                <tr>
                    <td colspan="7">No accepted requests found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>


    
@endsection
