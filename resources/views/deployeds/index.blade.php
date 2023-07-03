@extends('layouts.app')

@section('content')
    <h1>Deployed Records</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('deployedItems.downloadReports') }}" class="btn btn-primary">Download Reports</a>
    <table class="table">
        <thead>
            <tr>
                <th>Requested By</th>
                <th>Unit No</th>
                <th>Item Requested</th>
                <th>Quantity</th>
                <th>Deployed By</th>
                <th>Date</th>
                <th>Action</th> <!-- Add this column for the PDF download button -->
            </tr>
        </thead>
        <tbody>
            @foreach ($deployeds as $deployed)
                <tr>
                    <td>{{ $deployed->requested_by }}</td>
                    <td>{{ $deployed->unit_no }}</td>
                    <td>{{ $deployed->item_requested }}</td>
                    <td>{{ $deployed->quantity }}</td>
                    <td>{{ $deployed->deployed_by }}</td>
                    <td>{{ $deployed->date }}</td>
                    <td>
                        <a href="{{ route('deployeds.downloadPdf', ['id' => $deployed->id]) }}" class="btn btn-primary">Download PDF</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
