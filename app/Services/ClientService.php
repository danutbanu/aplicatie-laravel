<?php

namespace App\Services;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function createClient(array $data, Request $request): Client
    {
        $data['identity_front_photo'] = $request->file('identity_front_photo')->store('clients', 'public');
        $data['identity_back_photo'] = $request->file('identity_back_photo')->store('clients', 'public');

        return Client::create($data);
    }

    public function updateClient(Client $client, array $data, Request $request): Client
    {
        if ($request->hasFile('identity_front_photo')) {
            if ($client->identity_front_photo) {
                Storage::disk('public')->delete($client->identity_front_photo);
            }

            $data['identity_front_photo'] = $request->file('identity_front_photo')->store('clients', 'public');
        }

        if ($request->hasFile('identity_back_photo')) {
            if ($client->identity_back_photo) {
                Storage::disk('public')->delete($client->identity_back_photo);
            }

            $data['identity_back_photo'] = $request->file('identity_back_photo')->store('clients', 'public');
        }

        $client->update($data);

        return $client;
    }

    public function deleteClient(Client $client): void
    {
        if ($client->identity_front_photo) {
            Storage::disk('public')->delete($client->identity_front_photo);
        }

        if ($client->identity_back_photo) {
            Storage::disk('public')->delete($client->identity_back_photo);
        }

        $client->delete();
    }
}
