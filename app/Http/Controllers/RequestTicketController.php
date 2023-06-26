<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestTicket;
use App\Models\Category;

class RequestTicketController extends Controller
{
    public function index()
    {
        $request_tickets = RequestTicket::all();
        return view('request_tickets.index', compact('request_tickets'));
    }

    public function create()
    {
        $categories = Category::pluck('name', 'id');
        return view('request_tickets.create', compact('categories'));
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'requestor_name' => 'required',
        'unit_no' => 'required',
        'items_requested' => 'required|array',
        'quantity' => 'required|array',
    ]);

    // Retrieve the selected category IDs and quantities from the request
    $categoryIds = $validatedData['items_requested'];
    $quantities = $validatedData['quantity'];

    // Retrieve the category names associated with the selected category IDs
    $categories = Category::whereIn('id', $categoryIds)->pluck('name')->toArray();

    // Combine the categories and quantities into concatenated strings
    $itemsRequested = implode(', ', $categories);
    $quantitiesString = implode(', ', $quantities);

    // Create the request ticket with the concatenated items requested, quantities, and unit number
    $requestTicket = new RequestTicket();
    $requestTicket->requestor_name = $validatedData['requestor_name'];
    $requestTicket->unit_no = $validatedData['unit_no'];
    $requestTicket->items_requested = $itemsRequested;
    $requestTicket->quantity = $quantitiesString;
    $requestTicket->save();

    return redirect()->route('request_tickets.index')->with('success', 'Request ticket created successfully.');
}



    


    public function edit(RequestTicket $requestTicket)
    {
        return view('request_tickets.edit', compact('requestTicket'));
    }

    public function update(Request $request, RequestTicket $requestTicket)
    {
        $validatedData = $request->validate([
            'requestor_name' => 'required',
            'items_requested' => 'required',
            'quantity' => 'required|numeric',
        ]);

        $requestTicket->update($validatedData);

        return redirect()->route('request_tickets.index')->with('success', 'Request ticket updated successfully.');
    }

    public function destroy(RequestTicket $requestTicket)
    {
        $requestTicket->delete();

        return redirect()->route('request_tickets.index')->with('success', 'Request ticket deleted successfully.');
    }
}