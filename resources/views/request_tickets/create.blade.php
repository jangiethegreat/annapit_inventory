@extends('layouts.app')

@section('content')
    <h1>Create Request Ticket</h1>

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

        <button type="button" id="add-item">Add Item</button>

        <button type="submit" class="btn btn-primary">Create</button>
        <a href="{{ route('request_tickets.index') }}" class="btn btn-secondary">Back</a>
    </form>

    <style>
        .form-group.row {
            display: flex;
            align-items: center;
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
