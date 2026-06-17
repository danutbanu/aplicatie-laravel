@extends('layouts.public')

@section('content')
    <h1 class="page-title">Client details</h1>

    <div class="details-card">
        <p><strong>First name:</strong> {{ $client->first_name }}</p>
        <p><strong>Last name:</strong> {{ $client->last_name }}</p>
        <p><strong>CNP:</strong> {{ $client->cnp }}</p>
        <p><strong>Email:</strong> {{ $client->email }}</p>
        <p><strong>Phone:</strong> {{ $client->phone }}</p>
        <p><strong>Birth date:</strong> {{ $client->birth_date?->format('d.m.Y') }}</p>
        <p><strong>ID series:</strong> {{ $client->identity_series }}</p>
        <p><strong>ID number:</strong> {{ $client->identity_number }}</p>
        <p><strong>Street:</strong> {{ $client->street }}</p>
        <p><strong>City:</strong> {{ $client->city }}</p>
        <p><strong>County:</strong> {{ $client->county }}</p>
        <p><strong>Notes:</strong> {{ $client->notes }}</p>
    </div>

    @if ($client->identity_front_photo)
        <h2>ID front photo</h2>
        <img src="{{ asset('storage/' . $client->identity_front_photo) }}" alt="ID front photo" class="document-image" width="200">
        <a href="{{ asset('storage/' . $client->identity_front_photo) }}" download class="btn btn-secondary">Download front photo</a>
    @endif

    @if ($client->identity_back_photo)
        <h2>ID back photo</h2>
        <img src="{{ asset('storage/' . $client->identity_back_photo) }}" alt="ID back photo" class="document-image" width="200">
        <a href="{{ asset('storage/' . $client->identity_back_photo) }}" download class="btn btn-secondary">Download back photo</a>
    @endif

    <div class="actions">
        <a href="{{ route('clients.index') }}" class="btn btn-secondary">Back to clients</a>
        <a href="{{ route('clients.edit', $client) }}" class="btn btn-primary">Edit client</a>
    </div>
@endsection