<?php

namespace App\Services;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientDocumentService
{
    public function uploadDocuments(Request $request, array $data): array
    {
        $data['identity_front_photo'] = $request->file('identity_front_photo')->store('clients', 'public');
        $data['identity_back_photo'] = $request->file('identity_back_photo')->store('clients', 'public');

        return $data;
    }

    public function replaceDocuments(Request $request, Client $client, array $data): array
    {
        if ($request->hasFile('identity_front_photo')) {
            $this->deleteFile($client->identity_front_photo);

            $data['identity_front_photo'] = $request->file('identity_front_photo')->store('clients', 'public');
        }

        if ($request->hasFile('identity_back_photo')) {
            $this->deleteFile($client->identity_back_photo);

            $data['identity_back_photo'] = $request->file('identity_back_photo')->store('clients', 'public');
        }

        return $data;
    }

    public function deleteClientDocuments(Client $client): void
    {
        $this->deleteFile($client->identity_front_photo);
        $this->deleteFile($client->identity_back_photo);
    }

    private function deleteFile(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
