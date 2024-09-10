<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{

    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'city' => 'required|string|max:100',
            'siret' => 'required|string|max:14',
        ]);

        // Get the currently authenticated user
        $user = Auth::user();

        // Create the company and associate it with the user
        $company = Company::create([
            'name' => $validatedData['name'],
            'address' => $validatedData['address'],
            'postal_code' => $validatedData['postal_code'],
            'city' => $validatedData['city'],
            'siret' => $validatedData['siret'],
        ]);

        // Attach the company to the user
        $user->companies()->attach($company->id);

        return response()->json([
            'message' => 'Company created and linked to the user successfully.',
            'company' => $company,
        ], 201);
    }

}
