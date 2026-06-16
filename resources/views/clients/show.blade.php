@extends('layouts.public')

@section('content')
    <h1>Client details</h1>

    <p>First name: {{ $client->first_name }}</p>
    <p>Last name: {{ $client->last_name }}</p>
    <p>CNP: {{ $client->cnp }}</p>
    <p>Email: {{ $client->email }}</p>
    <p>Phone: {{ $client->phone }}</p>
    <p>Birth date: {{ $client->birth_date }}</p>
    <p>ID series: {{ $client->identity_series }}</p>
    <p>ID number: {{ $client->identity_number }}</p>
    <p>Street: {{ $client->street }}</p>
    <p>City: {{ $client->city }}</p>
    <p>County: {{ $client->county }}</p>
    <p>Notes: {{ $client->notes }}</p>

    <h2>ID front photo</h2>
    <img src="{{ asset('storage/' . $client->identity_front_photo) }}" width="200">
    <a href="{{ asset('storage/' . $client->identity_front_photo) }}" download>Download front photo</a>

    <h2>ID back photo</h2>
    <img src="{{ asset('storage/' . $client->identity_back_photo) }}" width="200">
    <a href="{{ asset('storage/' . $client->identity_back_photo) }}" download>Download back photo</a>

    <a href="{{ route('clients.index') }}">Back to clients</a>
    <a href="{{ route('clients.edit', $client) }}">Edit client</a>
@endsection
