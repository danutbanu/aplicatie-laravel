@extends('layouts.public')

@section('content')
    <h1>Clients</h1>

    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('clients.create') }}"
            class="inline-flex items-center rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
            Add client
        </a>

        <a href="{{ route('homepage') }}"
            class="inline-flex items-center rounded-md border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100">
            HomePage
        </a>
    </div>

    <form action="{{ route('clients.index') }}" method="GET" class="mb-6 space-y-4">
        <div>
            <label for="search" class="mb-1 block text-sm font-medium text-gray-700">Search by first name or last
                name</label>
            <input type="text" name="search" id="search" value="{{ request('search') }}"
                class="w-full max-w-md rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
        </div>

        <div>
            <label for="cnp" class="mb-1 block text-sm font-medium text-gray-700">Search by CNP</label>
            <input type="text" name="cnp" id="cnp" value="{{ request('cnp') }}"
                class="w-full max-w-md rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
        </div>

        <div>
            <label for="email" class="mb-1 block text-sm font-medium text-gray-700">Search by email</label>
            <input type="text" name="email" id="email" value="{{ request('email') }}"
                class="w-full max-w-md rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
        </div>

        <div>
            <label for="phone" class="mb-1 block text-sm font-medium text-gray-700">Search by phone</label>
            <input type="text" name="phone" id="phone" value="{{ request('phone') }}"
                class="w-full max-w-md rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
        </div>

        <div>
            <label for="county" class="mb-1 block text-sm font-medium text-gray-700">Filter by county</label>

            <select name="county" id="county"
                class="w-full max-w-md rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                <option value="">All counties</option>

                @foreach ($counties as $county)
                    <option value="{{ $county }}" @selected(request('county') === $county)>
                        {{ $county }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit"
                class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                Apply filters
            </button>

            <a href="{{ route('clients.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                Reset filters
            </a>
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

    <table>
        <thead>
            <tr>
                <th>
                    <a href="{{ $sortUrl('first_name') }}" class="font-semibold text-blue-600 hover:text-blue-800">Full
                        Name</a>
                </th>
                <th>
                    <a href="{{ $sortUrl('cnp') }}" class="font-semibold text-blue-600 hover:text-blue-800">CNP</a>
                </th>
                <th>
                    <a href="{{ $sortUrl('email') }}" class="font-semibold text-blue-600 hover:text-blue-800">Email</a>
                </th>
                <th>
                    <a href="{{ $sortUrl('phone') }}" class="font-semibold text-blue-600 hover:text-blue-800">Phone</a>
                </th>
                <th>
                    <a href="{{ $sortUrl('county') }}" class="font-semibold text-blue-600 hover:text-blue-800">County</a>
                </th>
                <th>
                    <a href="{{ $sortUrl('created_at') }}"
                        class="font-semibold text-blue-600 hover:text-blue-800">Registration Date</a>
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
                        <div class="flex items-center gap-2">
                            <a href="{{ route('clients.show', $client) }}"
                                class="text-sm font-medium text-blue-600 hover:text-blue-800">View</a>

                            <a href="{{ route('clients.edit', $client) }}"
                                class="text-sm font-medium text-amber-600 hover:text-amber-800">Edit</a>

                            <form action="{{ route('clients.destroy', $client) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this client?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="rounded-md bg-red-600 px-3 py-1 text-sm font-medium text-white hover:bg-red-700">
                                    Delete
                                </button>
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
