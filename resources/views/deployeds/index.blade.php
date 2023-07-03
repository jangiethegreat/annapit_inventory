@extends('layouts.app')

@section('content')
    <h1>Deployed Records</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="report-section" style="padding: 20px;">
        <a href="{{ route('deployedItems.downloadReports') }}" class="btn btn-outline-primary">Download Daily Reports</a> 
    </div>

    <div class="row">
        @foreach ($deployeds as $deployed)
            <div class="col-md-4 mb-4">
                <div class="card border-success mb-3">
                    <div class="card-header bg-transparent border-success"><strong>Unit No:</strong>{{ $deployed->unit_no }}</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $deployed->item_requested }}</h5>
                        <p class="card-text">
                            <strong>Requested By:</strong> {{ $deployed->requested_by }}<br>
                            <strong>Quantity:</strong> {{ $deployed->quantity }}<br>
                            <strong>Deployed By:</strong> {{ $deployed->deployed_by }}<br>
                            <strong>Date:</strong> {{ $deployed->date }}
                        </p>
                    </div>
                    <div class="card-footer bg-transparent border-success">
                        <a href="{{ route('deployeds.downloadPdf', ['id' => $deployed->id]) }}" class="btn btn-warning">Download PDF</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
