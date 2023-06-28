<?php

namespace App\Http\Controllers;

use App\Models\RequestTicket;
use App\Models\AcceptedTicket;
use App\Models\Stock;


use Illuminate\Http\Request;

class AcceptedTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $acceptedTickets = AcceptedTicket::all();

        $itemsRequested = $acceptedTickets->pluck('items_requested')->toArray();

        $stocks = Stock::whereIn('category', $itemsRequested)->get();

        return view('accepted_tickets.index', compact('acceptedTickets', 'stocks'));
    }

    public function create($id)
    {
        $requestTicket = RequestTicket::findOrFail($id);
        $requestTicket->delete();

        return view('accepted_tickets.create', compact('requestTicket'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'requestor_name' => 'required',
            'unit_no' => 'required',
            'items_requested' => 'required',
            'quantity' => 'required',
            'remarks' => 'nullable',
        ]);

        $validatedData['status'] = 'Pending';
        $validatedData['item_requested'] = $validatedData['items_requested'];

        AcceptedTicket::create($validatedData);


        return redirect()->route('accepted_tickets.index')->with('success', 'Accepted request created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $acceptedTicket = AcceptedTicket::findOrFail($id);
        $acceptedTicket->update([
            'status' => 'Accepted',
            'remarks' => 'Ready For Deployment'
        ]);

        return redirect()->route('accepted_tickets.index')->with('success', 'Accepted request status updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function deploy($id)
    {
        $acceptedTicket = AcceptedTicket::findOrFail($id);

        $itemsRequested = explode(', ', $acceptedTicket->items_requested);

        $stocks = Stock::whereIn('category', $itemsRequested)->get();

        return view('accepted_tickets.deploy', compact('acceptedTicket', 'stocks'));
    }


}