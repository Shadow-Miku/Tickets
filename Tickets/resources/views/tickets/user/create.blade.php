@extends('layouts.user')

@section('title', 'New Ticket')

@section('contents')
<h1 class="font-bold text-2xl ml-3">Create New Ticket</h1>
<hr/>
<div class="border-b border-gray-900/10 pb-12">
    <div class="mt-10 flex">
        <!-- Left column: Form -->
            <form action="{{ route('user/tickets/store') }}" method="POST">
                @csrf
                <input type="hidden" name="autorid" id="autorid" value="{{ auth()->user()->id }}">

                <div class="sm:col-span-4">
                    <label for="clasification" class="block text-sm font-medium leading-6 text-gray-900">Classification</label>
                    <div class="mt-2">
                        <select id="clasification" name="clasification" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required onchange="toggleOtherField()">
                            <option value="" disabled selected>Select one of the following issues...</option>
                            <option value="Office Failure">Office Failure</option>
                            <option value="Network Failures">Network Failures</option>
                            <option value="Software Errors">Software Errors</option>
                            <option value="Hardware Errors">Hardware Errors</option>
                            <option value="Preventive Maintenance">Preventive Maintenance</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>

                {{-- <div class="sm:col-span-4" id="otherField" style="display: none;">
                    <label for="other" class="block text-sm font-medium leading-6 text-gray-900">Please specify</label>
                    <div class="mt-2">
                        <input type="text" id="other" name="other" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div> --}}

                <div class="sm:col-span-4">
                    <label class="block text-sm font-medium leading-6 text-gray-900">Details</label>
                    <div class="mt-2">
                        <textarea id="details" name="details" class="form-control" rows="3" placeholder="Provide details about the issue"></textarea>
                    </div>
                </div>

                <div class="flex justify-between mt-10">
                    <button type="submit" class="flex-shrink-0 rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Submit</button>
                    <a id="backButton" href="{{ url()->previous() }}" class="flex-shrink-0 ml-4 rounded-md bg-gray-500 px-4 py-2 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-gray-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-500">Return</a>
                </div>
            </form>
    </div>
</div>

<script>
    /* function toggleOtherField() {
        var select = document.getElementById('clasification');
        var otherField = document.getElementById('otherField');
        if (select.value === 'Other') {
            otherField.style.display = 'block';
        } else {
            otherField.style.display = 'none';
        }
    } */
</script>

@endsection
