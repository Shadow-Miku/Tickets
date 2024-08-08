@extends('layouts.admin')

@section('title', 'New Division')

@section('contents')
<h1 class="font-bold text-2xl ml-3">New Division</h1>
<hr/>
<div class="border-b border-gray-900/10 pb-12">
    <div class="mt-10 flex">
            <form action="{{ route('admin/divisions/store') }}" method="POST" enctype="multipart/form-data">
                @csrf


                <div class="sm:col-span-4">
                    <label class="block text-sm font-medium leading-6 text-gray-900">Name of the division</label>
                    <div class="mt-2">
                        <input id="name" name="name" type="text" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                    </div>
                </div>

                <div class="flex justify-between mt-10">
                    <button type="submit" class="flex-shrink-0 rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
                    <a id="backButton" href="{{ url()->previous() }}" class="flex-shrink-0 ml-4 rounded-md bg-gray-500 px-4 py-2 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-gray-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500">Return</a>
                </div>
            </form>
    </div>
</div>



@endsection
