@extends('layouts.public')

@section('content')
    <h1>Clients</h1>

    <a href="{{ route('clients.create') }}">Add client</a>

    <form action="{{ route('clients.index') }}" method="GET">
        <div>
            <label for="search">Search by first name or last name</label>
            <input type="text" name="search" id="search" value="{{ request('search') }}">
        </div>

        <div>
            <label for="cnp">Search by CNP</label>
            <input type="text" name="cnp" id="cnp" value="{{ request('cnp') }}">
        </div>

        <div>
            <label for="email">Search by email</label>
            <input type="text" name="email" id="email" value="{{ request('email') }}">
        </div>

        <div>
            <label for="phone">Search by phone</label>
            <input type="text" name="phone" id="phone" value="{{ request('phone') }}">
        </div>

        <div>
            <label for="county">Filter by county</label>

            <select name="county" id="county">
                <option value="">All counties</option>

                @foreach ($counties as $county)
                    <option value="{{ $county }}" @selected(request('county') === $county)>
                        {{ $county }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit">Apply filters</button>
        <a href="{{ route('clients.index') }}">Reset filters</a>
    </form>

    <table>
        <thead>
            <tr>
                <th>Full Name</th>
                <th>CNP</th>
                <th>Email</th>
                <th>Phone</th>
                <th>County</th>
                <th>Registration Date</th>
                <th>ID Documents</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($clients as $client)
                <tr>
                    <td>{{ $client->first_name }} {{ $client->last_name }}</td>
                    <td>{{ $client->cnp }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->phone }}</td>
                    <td>{{ $client->county }}</td>
                    <td>{{ $client->created_at->format('d.m.Y') }}</td>
                    <td>
                        @if ($client->identity_front_photo && $client->identity_back_photo)
                            Yes
                        @else
                            No
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('clients.show', $client) }}">View</a>
                        <a href="{{ route('clients.edit', $client) }}">Edit</a>

                        <form action="{{ route('clients.destroy', $client) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this client?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">No clients found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $clients->withQueryString()->links() }}
@endsection
