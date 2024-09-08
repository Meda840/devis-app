<?php

namespace App\Http\Controllers;

use App\Models\Devis;
use App\Models\Currency;
use App\Models\DevisTask;
use App\Models\Service;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use PDF;

class DevisController extends Controller
{


    public function index()
    {
        return response()->json(['message' => 'Hello, World!'], 200);
    }

    public function getAllCurrencies()
    {
        $currencies = Currency::all();
        return response()->json($currencies);
    }

    public function getAllServices()
    {
        $services = Service::all();
        return response()->json($services);
    }

    /**
     * Store a newly created Devis in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            // Professional (Pro) details
            'pro_name' => 'required|string|max:255',
            'pro_address' => 'required|string|max:255',
            'pro_city' => 'required|string|max:255',
            'pro_siret' => 'nullable|string|max:14',

            // Client details
            'client_name' => 'required|string|max:255',

            'client_address' => 'required|string|max:255',
            'client_city' => 'required|string|max:255',
            'client_siret' => 'nullable|string|max:14',

            // Devis details
            'description' => 'required',
            'amount' => 'required|numeric',
            'date_devis' => 'required|date',

            // Tasks details
            'tasks' => 'required|array',
            'tasks.*.item_description' => 'required|string|max:255',
            'tasks.*.item_price' => 'required|numeric',
            'tasks.*.item_quantity' => 'required|integer|min:1',
        ]);

        try {
            // Create the Devis
            $devis = Devis::create([
                'pro_name' => $validatedData['pro_name'],
                'pro_address' => $validatedData['pro_address'],
                'pro_city' => $validatedData['pro_city'],
                'pro_siret' => $validatedData['pro_siret'],
                'client_name' => $validatedData['client_name'],
                'client_address' => $validatedData['client_address'],
                'client_city' => $validatedData['client_city'],
                'client_siret' => $validatedData['client_siret'],
                'description' => $validatedData['description'],
                'amount' => $validatedData['amount'],
                'date_devis' => $validatedData['date_devis'],
            ]);

            // // Handle tasks
            foreach ($validatedData['tasks'] as $task) {
                $devis->tasks()->create([
                    'item_description' => $task['item_description'],
                    'item_price' => $task['item_price'],
                    'item_quantity' => $task['item_quantity'],
                ]);
            }
            $this->generatePdf($devis->id);
            return response()->json(['message' => 'Devis created successfully!', 'devis' => $devis], 201);
        } catch (ValidationException $e) {
            // Handle validation exceptions
            return response()->json(['error' => $e->errors()], 422);
        } catch (Exception $e) {
            // Log the error details
            Log::error('Error creating Devis: ' . $e->getMessage(), [
                'exception' => $e
            ]);

            // Handle other exceptions
            return response()->json(['error' => 'An error occurred while creating the devis.'], 500);
       }


    }

    public function generatePdf($id)
    {
        $devis = Devis::findOrFail($id);
        $pdf = PDF::loadView('pdf.devis', ['devis' => $devis]);
        return $pdf->download("devis_{$id}.pdf");
    }
}
