@extends('layouts.admin')

@section('title', 'Users')

@section('contents')
<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="font-bold text-2xl">Users</h1>
        <a href="{{ route('admin/users/create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add User</a>
    </div>
    <hr class="mb-4"/>

    @if(Session::has('success'))
    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
        {{ Session::get('success') }}
    </div>
    @endif

    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Name</th>
                <th scope="col" class="px-6 py-3">Email</th>
                <th scope="col" class="px-6 py-3">Type</th>
                <th scope="col" class="px-6 py-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="px-6 py-4">{{ $user->name }}</td>
                <td class="px-6 py-4">{{ $user->email }}</td>
                <td class="px-6 py-4">{{ $user->type }}</td>
                <td class="px-6 py-4 w-36">
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('admin/users/show', $user->id) }}" class="text-blue-600 hover:text-blue-800">Detail</a>
                        <a href="{{ route('admin/users/edit', $user->id) }}" class="text-yellow-600 hover:text-yellow-800">Edit</a>
                        @if ($user->id !== $currentUserId)
                            <form action="{{ route('admin/users/destroy', $user->id) }}" method="POST" onsubmit="return confirm('Delete?')" class="inline-block text-red-600 hover:text-red-800">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
