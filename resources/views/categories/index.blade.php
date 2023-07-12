@extends('layouts.app')

@section('content')
<h1>Categories</h1>
<a href="{{ route('categories.create') }}" class="btn btn-primary"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Create Category</a>
<hr>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="row">
    @foreach($categories as $category)
    <div class="col-md-4 mb-4">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title"> {{ $category->name }}</h5>
                <p class="card-text">

                    ID: {{ $category->id}}
                </p>
                <div class="card-footer d-flex justify-content-center">
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info" style="margin:5px;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline;margin:5px;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                    </form>
                </div>
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