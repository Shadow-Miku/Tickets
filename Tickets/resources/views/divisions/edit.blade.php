@extends('layouts.admin')

@section('title', 'Editar Registro')

@section('contents')
<h1 class="font-bold text-2xl ml-3">Editar registro</h1>
<hr />
<div class="border-b border-gray-900/10 pb-12">
    <div class="mt-10 flex">
        <!-- Left column: Form -->
        <div class="w-1/2 pr-6">
            <form action="{{ route('admin/divisions/update', $division->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="sm:col-span-4">
                    <label class="block text-sm font-medium leading-6 text-gray-900">Current Name $division->name  </label>
                    <div class="mt-2">
                        <input id="name" name="name" type="text" value="{{ $division->name }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                    </div>
                </div>

                <div class="flex justify-between mt-10">
                    <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
                    <a id="backButton" href="{{ url()->previous() }}" class="flex justify-center ml-4 w-full rounded-md bg-gray-500 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-gray-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500">Return</a>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection
