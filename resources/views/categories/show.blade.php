<!-- resources/views/categories/show.blade.php -->
@extends('layouts.app')

@section('content')
    <h1>Category Details</h1>
    <table class="table">
        <tr>
            <th>ID</th>
            <td>{{ $category->id }}</td>
        </tr>
        <tr>
            <th>Name</th>
            <td>{{ $category->name }}</td>
        </tr>
    </table>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
@endsection