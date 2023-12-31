<?php

namespace App\Http\Controllers;

use App\Models\Deployed;
use App\Models\AcceptedTicket;
use App\Models\Cart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;
use Barryvdh\DomPDF\Facade as PDF;


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

    public function downloadPdf($id)
    {
        $deployeds = Deployed::find($id);

        if (!$deployeds) {
            return redirect()->route('deployeds.index')->with('error', 'Deployed item not found.');
        }

        $path = public_path() . '/annaplogo.jpg';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);

        if ($deployeds->unit_no == 'ASAI') {
            $path = public_path() . '/logo.png';
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
        } elseif ($deployeds->unit_no == 'Finance') {
            $path = public_path() . '/Logo1.png';
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
        } elseif ($deployeds->unit_no == 'Annap 1') {
            $path = public_path() . '/Logo2.jpg';
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
        } elseif ($deployeds->unit_no == 'Annap 2') {
            $path = public_path() . '/Logo3.png';
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
        } elseif ($deployeds->unit_no == 'Annap 3') {
            $path = public_path() . '/Logo4.png';
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
        } elseif ($deployeds->unit_no == 'Consult') {
            $path = public_path() . '/Logo5.png';
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
        } elseif ($deployeds->unit_no == 'Marketing') {
            $path = public_path() . '/Logo6.png';
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
        }

        $image = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $currentDate = Carbon::now()->format('Y/m/d');

        $fileName = $deployeds->unit_no . '-Request-form-' . $currentDate . '.pdf';

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::setOptions(['isHTML5ParserEnabled' => true, 'isRemoteEnabled' => true])
            ->loadView('pdf\deployed-item', compact('deployeds', 'currentDate', 'image'));

        return $pdf->download($fileName);
    }

    public function downloadReports()
    {
        // Get today's date
        $today = Carbon::today();

        // Retrieve deployed items added today
        $deployeds = Deployed::whereDate('date', $today)->get();

        // Set the default image path and type
        $defaultImagePath = public_path() . '/annaplogo.jpg';
        $defaultImageType = pathinfo($defaultImagePath, PATHINFO_EXTENSION);
        $defaultImageData = file_get_contents($defaultImagePath);

        // Generate the HTML table for the report
        $html = '
        <html>
            <head>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                    }
                    h1 {
                        text-align: center;
                        margin-bottom: 20px;
                    }
                    table {
                        width: 100%;
                        border-collapse: collapse;
                    }
                    th, td {
                        padding: 10px;
                        text-align: left;
                        border-bottom: 1px solid #ddd;
                        border: 1px solid #ddd; /* Add border property */
                    }
                    th {
                        background-color: #f5f5f5;
                    }
                    .logo-container {
                        text-align: center;
                        align-items: center;
                        margin-bottom: 20px;
                    }
                    .logo-container img {
                        width: 450px;
                        height: 120px;
                    }
                </style>
            </head>
            <body>
                <div class="logo-container">
                    <img src="' . 'data:image/' . $defaultImageType . ';base64,' . base64_encode($defaultImageData) . '" alt="image">
                </div>
                <h1>Deployed Items Report ' . $today->format('Y-m-d') . '</h1>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Requested By</th>
                            <th>Unit No</th>
                            <th>Deployed By</th>
                            <th>Item Details</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>';

        foreach ($deployeds as $deployed) {
            $html .= '
            <tr>
                <td>' . $deployed->requested_by . '</td>
                <td>' . $deployed->unit_no . '</td>
                <td>' . $deployed->deployed_by . '</td>
                <td>' . $deployed->item_requested . '</td>
                <td>' . $deployed->quantity . '</td>
            </tr>';
        }

        $html .= '
                    </tbody>
                </table>
            </body>
        </html>';

        // Configure PDF options
        $options = new Options();
        $options->set('defaultFont', 'Arial');

        // Create a new DOMPDF instance
        $dompdf = new Dompdf($options);

        // Load the HTML into DOMPDF
        $dompdf->loadHtml($html);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Generate the PDF file name
        $fileName = 'deployed_items_report_' . $today->format('Y-m-d') . '.pdf';

        // Download the PDF file
        $dompdf->stream($fileName, ['Attachment' => true]);
    }
    public function generateSticker()
    {
        // Create new Dompdf instance
        $dompdf = new Dompdf();

        // Generate the HTML content for the sticker
        $html = '<div style="
        width: 200px;
        height: 100px;
        background-color: yellow;
        border: 2px solid black;
        padding: 10px;
        text-align: center;
        overflow: hidden; /* Prevents content overflow */
        word-wrap: break-word; /* Wraps long words */
    ">
        <h1 style="margin: 0;">Sticker Content</h1>
        <p style="margin: 0;">This is a sticker that will be printed in the PDF.</p>
    </div>';

        // Load HTML content
        $dompdf->loadHtml($html);

        // Set paper size and orientation (optional)
        $dompdf->setPaper('A4', 'portrait');

        // Render the PDF
        $dompdf->render();

        // Output the generated PDF to the browser
        $dompdf->stream('document.pdf');
    }
}
