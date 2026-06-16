<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::latest()->paginate(10);

        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'cnp' => 'required|string|size:7|unique:clients,cnp',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'required|string|max:20',
            'birth_date' => 'required|date',
            'identity_series' => 'required|string|max:20',
            'identity_number' => 'required|string|max:20',
            'street' => 'required|string|max:30',
            'city' => 'required|string|max:100',
            'county' => 'required|string|max:100',
            'identity_front_photo' => 'required|image|mimes:jpg,jpeg,png|max:5120',
            'identity_back_photo' => 'required|image|mimes:jpg,jpeg,png|max:5120',
            'notes' => 'nullable|string',
        ]);

        $validated['identity_front_photo'] = $request->file('identity_front_photo')->store('clients', 'public');
        $validated['identity_back_photo'] = $request->file('identity_back_photo')->store('clients', 'public');

        Client::create($validated);

        return redirect()->route('clients.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //
    }
}
