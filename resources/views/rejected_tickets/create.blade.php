@extends('layouts.app')

@section('content')
    <h1>Create Rejected Ticket</h1>

    <form action="{{ route('rejected_tickets.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="requestor_name">Requestor's Name:</label>
            <input type="text" name="requestor_name" id="requestor_name" class="form-control" value="{{ $requestTicket->requestor_name }}" required>
        </div>

        <div class="form-group">
            <label for="unit_no">Unit No:</label>
            <input type="text" name="unit_no" id="unit_no" class="form-control" value="{{ $requestTicket->unit_no }}" required>
        </div>

        <div class="form-group">
            <label for="items_requested">Items Requested:</label>
            <input type="text" name="items_requested" id="items_requested" class="form-control" value="{{ $requestTicket->items_requested }}" required>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="text" name="quantity" id="quantity" class="form-control" value="{{ $requestTicket->quantity }}" required>
        </div>

        <div class="form-group">
            <label for="remarks">Remarks:</label>
            <input type="text" name="remarks" id="remarks" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
        <a href="{{ route('request_tickets.index') }}" class="btn btn-secondary">Back</a>
    </form>
@endsection
