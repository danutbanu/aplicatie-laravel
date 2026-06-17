<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Services\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, ClientService $clientService)
    {
        $clients = $clientService->getFilteredClients($request);
        $counties = $this->counties();

        return view('clients.index', compact('clients', 'counties'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $counties = $this->counties();

        return view('clients.create', compact('counties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request, ClientService $clientService)
    {
        $clientService->createClient($request->validated(), $request);

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
        $counties = $this->counties();

        return view('clients.edit', compact('client', 'counties'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, Client $client, ClientService $clientService)
    {
        $clientService->updateClient($client, $request->validated(), $request);

        return redirect()->route('clients.show', $client);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client, ClientService $clientService)
    {
        $clientService->deleteClient($client);

        return redirect()->route('clients.index');
    }

    private function counties(): array
    {
        return [
            'Alba',
            'Arad',
            'Argeș',
            'Bacău',
            'Bihor',
            'Bistrița-Năsăud',
            'Botoșani',
            'Brașov',
            'Brăila',
            'București',
            'Buzău',
            'Caraș-Severin',
            'Călărași',
            'Cluj',
            'Constanța',
            'Covasna',
            'Dâmbovița',
            'Dolj',
            'Galați',
            'Giurgiu',
            'Gorj',
            'Harghita',
            'Hunedoara',
            'Ialomița',
            'Iași',
            'Ilfov',
            'Maramureș',
            'Mehedinți',
            'Mureș',
            'Neamț',
            'Olt',
            'Prahova',
            'Satu Mare',
            'Sălaj',
            'Sibiu',
            'Suceava',
            'Teleorman',
            'Timiș',
            'Tulcea',
            'Vaslui',
            'Vâlcea',
            'Vrancea',
        ];
    }
}
