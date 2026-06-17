@extends('layouts.public')

@section('content')
    <h1 class="page-title">Clients</h1>

    <div class="actions">
        <a href="{{ route('clients.create') }}" class="btn btn-primary">Add client</a>
        <a href="{{ route('homepage') }}" class="btn btn-secondary">HomePage</a>
    </div>

    <form action="{{ route('clients.index') }}" method="GET">
        <div class="form-group">
            <label for="search" class="form-label">Search by first name or last name</label>
            <input type="text" name="search" id="search" value="{{ request('search') }}" class="form-input">
        </div>

        <div class="form-group">
            <label for="cnp" class="form-label">Search by CNP</label>
            <input type="text" name="cnp" id="cnp" value="{{ request('cnp') }}" class="form-input">
        </div>

        <div class="form-group">
            <label for="email" class="form-label">Search by email</label>
            <input type="text" name="email" id="email" value="{{ request('email') }}" class="form-input">
        </div>

        <div class="form-group">
            <label for="phone" class="form-label">Search by phone</label>
            <input type="text" name="phone" id="phone" value="{{ request('phone') }}" class="form-input">
        </div>

        <div class="form-group">
            <label for="county" class="form-label">Filter by county</label>

            <select name="county" id="county" class="form-select">
                <option value="">All counties</option>

                @foreach ($counties as $county)
                    <option value="{{ $county }}" @selected(request('county') === $county)>
                        {{ $county }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="actions">
            <button type="submit" class="btn btn-primary">Apply filters</button>
            <a href="{{ route('clients.index') }}" class="link">Reset filters</a>
        </div>
    </form>

    @php
        $sortUrl = function ($column) {
            $currentSort = request('sort');
            $currentDirection = request('direction', 'desc');

            $direction = $currentSort === $column && $currentDirection === 'asc' ? 'desc' : 'asc';

            return route(
                'clients.index',
                array_merge(request()->query(), [
                    'sort' => $column,
                    'direction' => $direction,
                ]),
            );
        };
    @endphp

    <table class="table">
        <thead>
            <tr>
                <th>
                    <a href="{{ $sortUrl('first_name') }}" class="link">Full Name</a>
                </th>
                <th>
                    <a href="{{ $sortUrl('cnp') }}" class="link">CNP</a>
                </th>
                <th>
                    <a href="{{ $sortUrl('email') }}" class="link">Email</a>
                </th>
                <th>
                    <a href="{{ $sortUrl('phone') }}" class="link">Phone</a>
                </th>
                <th>
                    <a href="{{ $sortUrl('county') }}" class="link">County</a>
                </th>
                <th>
                    <a href="{{ $sortUrl('created_at') }}" class="link">Registration Date</a>
                </th>
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
                        <div class="actions">
                            <a href="{{ route('clients.show', $client) }}" class="link">View</a>
                            <a href="{{ route('clients.edit', $client) }}" class="link-warning">Edit</a>

                            <form action="{{ route('clients.destroy', $client) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this client?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
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
