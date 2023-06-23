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
            ' ' => 'required',
            'quantity' => 'required|numeric',
        ]);

        // Retrieve the selected category ID from the request
        $categoryId = $validatedData['category'];

        // Retrieve the category name associated with the selected category ID
        $category = Category::findOrFail($categoryId);
        $categoryName = $category->name;

        // Create the request ticket with the selected category name
        $requestTicket = new RequestTicket();
        $requestTicket->requestor_name = $validatedData['requestor_name'];
        $requestTicket->items_requested = $categoryName;
        $requestTicket->quantity = $validatedData['quantity'];
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