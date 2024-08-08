@extends('layouts.admin')

@section('title', 'User Info')

@section('contents')
<h1 class="font-bold text-2xl ml-3">User Information</h1>
<hr />
<div class="border-b border-gray-900/10 pb-12">
    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-2">
        <!-- Left column: Info -->
        <div class="space-y-8">
            <div class="sm:col-span-4">
                <label class="block text-sm font-medium leading-6 text-gray-900">Full Name</label>
                <div class="mt-2">
                    {{ $user->name }}
                </div>
            </div>

            <div class="sm:col-span-4">
                <label class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                <div class="mt-2">
                    {{ $user->email }}
                </div>
            </div>

            <div class="sm:col-span-4">
                <label class="block text-sm font-medium leading-6 text-gray-900">Rank</label>
                <div class="mt-2">
                    {{ $user->type }}
                </div>
            </div>

            <div class="sm:col-span-4">
                <label class="block text-sm font-medium leading-6 text-gray-900">Division</label>
                <div class="mt-2">
                    {{ $division->name ?? 'No Division' }}
                </div>
            </div>

            <div class="flex justify-end mt-4">
                <!-- Go back -->
                <a id="backButton" href="{{ url()->previous() }}" class="bg-gray-500 text-white px-2 py-2 rounded text-sm">Return</a>
            </div>
        </div>

        <!-- Rigth Column : Image -->
        <div class="w-1/2 pl-6">
            <label class="block text-sm font-medium leading-6 text-gray-900">Profile Image</label>
            <div class="mt-2">
                <img src="{{ asset('storage/' . $user->url) }}" alt="Profile Image" class="w-full h-auto">
            </div>
        </div>
    </div>
</div>

@endsection
