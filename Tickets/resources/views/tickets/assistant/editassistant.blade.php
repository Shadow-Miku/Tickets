@extends('layouts.assistant')

@section('title', 'Assigned Ticket')

@section('contents')

<div class="container mt-5">
    <h1 class="font-weight-bold text-2xl mb-4">Attend Ticket</h1>
    <hr />

    <div class="card shadow-sm border-0 p-4">
        <div class="card-body">
            <form action="{{ route('assistant/tickets/updateAttend', $ticket->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-bold">Ticket Classification</label>
                    <p class="form-control-plaintext">{{ $ticket->clasification }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Ticket Details</label>
                    <p class="form-control-plaintext">{{ $ticket->details }}</p>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">User commentary's</label>
                    <p class="form-control-plaintext text-muted">
                        {{ $chat && $chat->commentary ? $chat->commentary : 'No comments' }}
                    </p>
                </div>


                <div class="mb-3">
                    <label for="status" class="form-label fw-bold">Status</label>
                    <select class="form-select" name="status" id="status">
                        <option disabled selected>Select a ticket status...</option>
                        <option value="Completed" @selected($ticket->status == 'Completed')>Completed</option>
                        <option value="In process" @selected($ticket->status == 'In process')>In process</option>
                        <option value="Never Solved" @selected($ticket->status == 'Never Solved')>Never Solved</option>
                    </select>
                    @if($errors->has('status'))
                        <p class="text-danger fst-italic">{{ $errors->first('status') }}</p>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="answer" class="form-label fw-bold">Answer</label>
                    <textarea id="answer" name="answer" class="form-control" rows="3" placeholder="Provide your answer">{{ $chat ? $chat->answer : '' }}</textarea>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Return</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
