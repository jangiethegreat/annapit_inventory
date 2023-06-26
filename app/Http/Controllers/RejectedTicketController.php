<?php

namespace App\Http\Controllers;
use  App\Models\RejectedTicket;
use  App\Models\RequestTicket;
use Illuminate\Http\Request;

class RejectedTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rejectedTickets = RejectedTicket::all();
        return view('rejected_tickets.index', compact('rejectedTickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
{
    $requestTicket = RequestTicket::findOrFail($id);
    $requestTicket->delete();

    return view('rejected_tickets.create', compact('requestTicket'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'requestor_name' => 'required',
            'unit_no' => 'required',
            'items_requested' => 'required',
            'quantity' => 'required',
            'remarks' => 'nullable',
        ]);

        RejectedTicket::create($validatedData);

        // Get the ID of the rejected ticket
        

     

        return redirect()->route('request_tickets.index')->with('success', 'Rejected ticket created successfully.');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
