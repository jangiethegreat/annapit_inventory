<?php

namespace App\Http\Controllers;

use App\Models\Deployed;
use App\Models\AcceptedTicket;
use App\Models\Cart;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;

class DeployedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deployeds = Deployed::all();
        return view('deployeds.index', compact('deployeds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(AcceptedTicket $acceptedTicket)
    {
        return view('deployeds.create', compact('acceptedTicket'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'requested_by' => 'required',
            'unit_no' => 'required',
            'item_requested' => 'required',
            'quantity' => 'required',
            'deployed_by' => 'required',
            'date' => 'required|date',
        ]);

        Deployed::create($validatedData);
        Cart::Truncate();

        return redirect()->route('deployeds.index')->with('success', 'Deployed record created successfully.');

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