@extends('layouts.app')

@section('content')
<h1>Create Deployed Record</h1>

<form action="{{ route('deployeds.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="requested_by">Requested By</label>
        <input type="text" name="requested_by" class="form-control" value="{{ session('acceptedTicket')->requestor_name }}" readonly>
    </div>
    <div class="form-group">
        <label for="unit_no">Company/Department</label>
        <input type="text" name="unit_no" class="form-control" value="{{ session('acceptedTicket')->unit_no }}" readonly>
    </div>
    <div class="form-group">
        <label for="item_requested">Item Requested</label>
        <input type="text" name="item_requested" class="form-control" value="{{ session('acceptedTicket')->items_requested }}" readonly>
    </div>
    <div class="form-group">
        <label for="quantity">Quantity</label>
        <input type="text" name="quantity" class="form-control" value="{{ session('acceptedTicket')->quantity }}" readonly>
    </div>
    <div class="form-group">
        <label for="deployed_by">Deployed By</label>
        <input type="text" name="deployed_by" class="form-control">
    </div>
    <div class="form-group">
        <label for="date">Date</label>
        <input type="date" name="date" class="form-control" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection