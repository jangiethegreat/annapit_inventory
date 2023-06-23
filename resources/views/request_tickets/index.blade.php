@extends('layouts.app')

@section('content')
    <h1>Request Tickets</h1>

    <a href="{{ route('request_tickets.create') }}" class="btn btn-primary mb-3">Create Request Ticket</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Requestor's Name</th>
                <th>Items Requested</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($request_tickets as $request_ticket)
                <tr>
                    <td>{{ $request_ticket->requestor_name }}</td>
                    <td>{{ $request_ticket->items_requested }}</td>
                    <td>{{ $request_ticket->quantity }}</td>
                    <td>
                        <a href="{{ route('request_tickets.edit', $request_ticket->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('request_tickets.destroy', $request_ticket->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this request ticket?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No request tickets found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
