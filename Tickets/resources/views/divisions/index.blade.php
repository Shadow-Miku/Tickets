@extends('layouts.admin')

@section('title', 'Divisions')

@section('contents')
<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="font-bold text-2xl">Actual Divisions</h1>
        <a href="{{ route('admin/divisions/create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">New</a>
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
                <th scope="col" class="px-6 py-3">#</th>
                <th scope="col" class="px-6 py-3">Name</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
            @if($division->count() > 0)
            @foreach($division as $dv)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                    {{ $loop->iteration }}
                </th>
                <td class="px-6 py-4">
                    {{ $dv->name }}
                </td>
                <td class="px-6 py-4 w-36">
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('admin/divisions/edit', $dv->id)}}" class="text-green-600 hover:text-green-800">Edit</a>
                        <form action="{{ route('admin/divisions/destroy', $dv->id) }}" method="POST" onsubmit="return confirm('Delete?')" class="inline-block text-red-600 hover:text-red-800">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td class="text-center px-6 py-4" colspan="3">No Divisions registered</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
