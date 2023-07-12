@extends('layouts.app')

@section('content')
<h1>Deployed Records</h1>

@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="report-section" style="padding: 20px;">
    <a href="{{ route('deployedItems.downloadReports') }}" class="btn btn-outline-primary"><i class="fa fa-download"></i> Download Daily Reports</a>
</div>

<hr>

<div class="row">
    @foreach ($deployeds as $deployed)
    <div class="col-md-4 mb-4">
        <div class="card text-center  border-dark mb-3" style="width: 18rem;">
            <div class="card-header bg-transparent border-dark"><strong>Requested By:</strong> {{ $deployed->requested_by }}</div>
            <div class="card-body">
                <h5 class="card-title">{{ $deployed->item_requested }}</h5>
                <p class="card-text">
                    <strong>Unit No:</strong>{{ $deployed->unit_no }}<br>
                    <strong>Quantity:</strong> {{ $deployed->quantity }}<br>
                    <strong>Deployed By:</strong> {{ $deployed->deployed_by }}<br>
                    <strong>Date:</strong> {{ $deployed->date }}
                </p>
            </div>
            <div class="card-footer bg-transparent border-dark">
                <a href="{{ route('deployeds.downloadPdf', ['id' => $deployed->id]) }}" class="btn btn-danger">
                    <i class="fa fa-file-pdf-o"></i> Download PDF
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>
<style>
    .card {
        box-shadow: 5px 5px 3px 6px lightgray;
    }
</style>
@endsection