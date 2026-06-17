<?php

namespace App\Services;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientService
{
    public function getFilteredClients(Request $request)
    {
        $query = Client::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->search . '%')
                    ->orWhere('last_name', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('cnp')) {
            $query->where('cnp', $request->cnp);
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->phone . '%');
        }

        if ($request->filled('county')) {
            $query->where('county', $request->county);
        }

        $allowedSorts = [
            'first_name',
            'last_name',
            'cnp',
            'email',
            'phone',
            'county',
            'created_at',
        ];

        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');

        if (! in_array($sort, $allowedSorts)) {
            $sort = 'created_at';
        }

        if (! in_array($direction, ['asc', 'desc'])) {
            $direction = 'desc';
        }

        return $query->orderBy($sort, $direction)->paginate(10)->withQueryString();
    }

    public function createClient(array $data): Client
    {
        return Client::create($data);
    }

    public function updateClient(Client $client, array $data): Client
    {
        $client->update($data);

        return $client;
    }

    public function deleteClient(Client $client): void
    {
        $client->delete();
    }
}
