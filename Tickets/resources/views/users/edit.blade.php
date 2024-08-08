@extends('layouts.admin')

@section('title', 'Editar Usuario')

@section('contents')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-4">Edit User</h1>
    <form action="{{ route('admin/users/update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-2 gap-6">
            <!-- Left Column: Form -->
            <div class="space-y-4">

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ $user->name }}" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ $user->email }}" required>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password (leave blank if not changing)</label>
                    <input type="password" name="password" id="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>

                <div class="mb-4">
                    <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                    <select name="type" id="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required data-selected-value="{{ $user->type }}">
                        <option value="0" data-display-value="User">User</option>
                        <option value="1" data-display-value="Admin">Admin</option>
                        <option value="2" data-display-value="Assistant">Assistant</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="divisionid" class="block text-sm font-medium text-gray-700">Division</label>
                    <select id="divisionid" name="divisionid" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                        @foreach($divisions as $div)
                            <option value="{{ $div->id }}" {{ $user->divisionid == $div->id ? 'selected' : '' }}>
                                {{ $div->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="url" class="block text-sm font-medium text-gray-700">Image</label>
                    <div class="mt-2">
                        <input type="file" id="url" name="url" class="block w-full text-gray-900" onchange="previewImage(this)">
                    </div>
                </div>
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Update</button>
                <a id="backButton" href="{{ url()->previous() }}" class="flex-shrink-0 ml-4 rounded-md bg-gray-500 px-4 py-2 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-gray-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500">Return</a>
            </div>

            <!-- Right Column: Image Preview -->
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Current Image</label>
                    <div class="mt-2">
                        <img id="imagePreview" src="{{ asset('storage/' . $user->url) }}" alt="Current Image" class="w-full h-auto rounded-md border border-gray-300">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function previewImage(input) {
        const file = input.files[0];
        const preview = document.getElementById('imagePreview');
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const preview = document.getElementById('imagePreview');
        preview.src = "{{ asset('storage/' . $user->url) }}";
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Obtener el select y el valor de tipo del data attribute
        const select = document.getElementById('type');
        const typeValue = select.getAttribute('data-selected-value');

        // Condición directa para seleccionar la opción correcta
        if (typeValue === 'admin') {
            select.value = '1';
        } else if (typeValue === 'assistant') {
            select.value = '2';
        } else if (typeValue === 'user') {
            select.value = '0';
        }
    });

</script>
@endsection
