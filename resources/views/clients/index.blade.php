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
            <img src="" alt="">

            <a href="{{ route('clients.edit', $client) }}">Edit</a>

            <a href="{{ route('clients.show', $client) }}">View</a>

            <form action="{{ route('clients.destroy', $client) }}" method="POST">
                @csrf
                @method('DELETE')

                <button type="submit">Delete client</button>
            </form>
        </div>
    @endforeach

    {{ $clients->links() }}
@endsection
