@extends('layouts.public')

@section('content')
    <h1>Clients</h1>

    <a href="{{ route('clients.create') }}">Add client</a>

    @foreach ($clients as $client)
        <div>
            <h2>{{ $client->first_name }} {{ $client->last_name }}</h2>
            <p>{{ $client->email }}</p>
            <p>{{ $client->phone }}</p>
            <p>{{ $client->cnp }}</p>

            <a href="{{ route('clients.show', $client) }}">View</a>
        </div>
    @endforeach

    {{ $clients->links() }}
@endsection
