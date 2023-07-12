@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header bg-transparent">
        <h1>Create Request Ticket</h1>
    </div>

    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('request_tickets.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="requestor_name">Requestor's Name:</label>
                <input type="text" name="requestor_name" id="requestor_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="unit_no">Unit No:</label>
                <input type="text" name="unit_no" id="unit_no" class="form-control" required>
            </div>

            <div id="items-container">
                <div class="item">
                    <div class="form-group row">
                        <div class="col">
                            <label for="items_requested">Items Requested:</label>
                            <select name="items_requested[]" class="form-control" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $categoryId => $categoryName)
                                <option value="{{ $categoryId }}">{{ $categoryName }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="quantity">Quantity:</label>
                            <input type="number" name="quantity[]" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <button type="button" class="remove-item">Remove</button>
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" id="add-item" class="btn btn-success" style="display: inline;margin:5px;">Add Item</button>
            </br>
            <button type="submit" class="btn btn-primary" style="display: inline; margin:5px;">Create</button>
            <a href="{{ route('request_tickets.index') }}" class="btn btn-secondary" style="display: inline; margin:5px;">Back</a>
        </form>
    </div>
</div>

<style>
    .card {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 70vh;
        height: auto;
        margin: auto;
        box-shadow: 10px 10px 5px 12px lightblue;
    }

    .card-header {
        width: 60vh;
        text-align: center;
    }

    .card-body {
        width: 60vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .form-group {
        width: 60vh;
    }

    .form-group.row {
        display: flex;
        align-items: center;
        width: 100%;
    }

    .form-group.row .col {
        flex: 1;
    }

    .col-auto {
        margin-top: auto;
        margin-bottom: auto;
    }

    .remove-item {
        display: none;
    }
</style>

<script>
    document.getElementById('add-item').addEventListener('click', function() {
        var itemsContainer = document.getElementById('items-container');
        var itemTemplate = document.querySelector('.item');
        var newItem = itemTemplate.cloneNode(true);
        newItem.querySelector('.remove-item').style.display = 'block'; // Show the remove button
        itemsContainer.appendChild(newItem);
    });

    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-item')) {
            var item = event.target.closest('.item');
            item.parentNode.removeChild(item);
        }
    });
</script>
@endsection