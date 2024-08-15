@extends('layouts.admin')

@section('title', 'Assign Ticket')

@section('contents')
<h1 class="font-bold text-2xl ml-3">Assign Ticket</h1>
<hr/>
<div class="border-b border-gray-900/10 pb-12">
    <div class="mt-10 flex">
        <!-- Left column: Form -->
            <form action="{{ route('admin/tickets/storeAssigment') }}" method="POST">
                @csrf
                <div class="ticket-item card mb-3">
                    <div class="card-header">
                        <h3 class="card-title">Ticket #{{ $ticket->id }} - {{ $ticket->clasification }}</h3>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $ticket->details }}</p>
                        <input type="hidden" name="ticketid" value="{{ $ticket->id }}">

                        <div class="mb-3">
                            <label for="assistant" class="form-label">Select an assistant</label>
                            <select name="accountableid" id="assistant" class="form-select" required>
                                <option value="">Select an assistant</option>
                                @foreach($assistants as $assistant)
                                    <option value="{{ $assistant->id }}">
                                        {{ $assistant->name }} ({{ $assistant->division->name }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
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
