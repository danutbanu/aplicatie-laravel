<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Services\ClientDocumentService;
use App\Services\ClientService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct(
        private ClientService $clientService,
        private ClientDocumentService $clientDocumentService,
    ) {}

    public function index(Request $request)
    {
        $clients = $this->clientService->getFilteredClients($request);
        $counties = $this->counties();

        return view('clients.index', compact('clients', 'counties'));
    }

    public function create()
    {
        $counties = $this->counties();

        return view('clients.create', compact('counties'));
    }

    public function store(StoreClientRequest $request)
    {
        $data = $request->validated();

        $data = $this->clientDocumentService->uploadDocuments($request, $data);

        $client = $this->clientService->createClient($data);

        return redirect()->route('clients.show', $client);
    }

    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
        $counties = $this->counties();

        return view('clients.edit', compact('client', 'counties'));
    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        $data = $request->validated();

        $data = $this->clientDocumentService->replaceDocuments($request, $client, $data);

        $this->clientService->updateClient($client, $data);

        return redirect()->route('clients.show', $client);
    }

    public function destroy(Client $client)
    {
        $this->clientDocumentService->deleteClientDocuments($client);

        $this->clientService->deleteClient($client);

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
