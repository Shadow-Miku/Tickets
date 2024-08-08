@extends('layouts.admin')

@section('title', 'New User')

@section('contents')
<h1 class="font-bold text-2xl ml-3">Registrar Usuario</h1>
<hr/>
<div class="border-b border-gray-900/10 pb-12">
    <div class="mt-10 flex">
        <!-- Left column: Form -->
        <div class="w-1/2 pr-6">
            <form action="{{ route('admin/users/store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="sm:col-span-4">
                    <label class="block text-sm font-medium leading-6 text-gray-900">Full Name</label>
                    <div class="mt-2">
                        <input id="name" name="name" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                    </div>
                </div>

                <div class="sm:col-span-4">
                    <label class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                    </div>
                </div>

                <div class="sm:col-span-4">
                    <label class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                    </div>
                </div>

                <div class="sm:col-span-4">
                    <label for="error" class="block text-sm font-medium leading-6 text-gray-900">User Type</label>
                    <div class="mt-2">
                        <select id="type" name="type" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                            <option value="0">User</option>
                            <option value="1">Admin</option>
                            <option value="2">Assistant</option>
                        </select>
                    </div>
                </div>

                <div class="sm:col-span-4">
                    <label for="division" class="block text-sm font-medium leading-6 text-gray-900">Division</label>
                    <div class="mt-2">
                        <select id="divisionid" name="divisionid" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                            @foreach($division as $div)
                            <option value="{{ $div->id }}" data-description="{{ $div->name }}">{{ $div->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="sm:col-span-4">
                    <label for="url" class="block text-sm font-medium leading-6 text-gray-900">Image</label>
                    <div class="mt-2">
                        <input type="file" id="url" name="url" class="block w-full text-gray-900" onchange="previewImage(this)">
                    </div>
                </div>

                <div class="flex justify-between mt-10">
                    <button type="submit" class="flex-shrink-0 rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
                    <a id="backButton" href="{{ url()->previous() }}" class="flex-shrink-0 ml-4 rounded-md bg-gray-500 px-4 py-2 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-gray-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500">Return</a>
                </div>
            </form>
        </div>

        <!-- Rigth Column : Image preview -->
        <div class="w-1/2 pl-6">
            <label class="block text-sm font-medium leading-6 text-gray-900">Preview</label>
            <div class="mt-2">
                <img id="imagePreview" src="" class="w-full h-auto">
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(input) {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('imagePreview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
