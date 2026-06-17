<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    public function store(StoreClientRequest $request)
    {
        $validated = $request->validated();

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
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        $validated = $request->validated();

        if ($request->hasFile('identity_front_photo')) {
            Storage::disk('public')->delete($client->identity_front_photo);

            $validated['identity_front_photo'] = $request->file('identity_front_photo')->store('clients', 'public');
        }

        if ($request->hasFile('identity_back_photo')) {
            Storage::disk('public')->delete($client->identity_back_photo);

            $validated['identity_back_photo'] = $request->file('identity_back_photo')->store('clients', 'public');
        }

        $client->update($validated);

        return redirect()->route('clients.show', $client);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        Storage::disk('public')->delete($client->identity_front_photo);
        Storage::disk('public')->delete($client->identity_back_photo);

        $client->delete();

        return redirect()->route('clients.index');
    }
}
