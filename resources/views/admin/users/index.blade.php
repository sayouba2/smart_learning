@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-6">Liste des utilisateurs</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full table-auto border-collapse">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">Nom</th>
                <th class="border px-4 py-2">Email</th>
                <th class="border px-4 py-2">Rôle</th>
                <th class="border px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="text-center">
                    <td class="border px-4 py-2">{{ $user->name }}</td>
                    <td class="border px-4 py-2">{{ $user->email }}</td>
                    <td class="border px-4 py-2 capitalize">{{ $user->role }}</td>
                    <td class="border px-4 py-2">
                        @if ($user->role !== 'admin')
                            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="role" value="admin">
                                <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
                                    Promouvoir en admin
                                </button>
                            </form>
                        @else
                            <span class="text-gray-500">Déjà admin</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
