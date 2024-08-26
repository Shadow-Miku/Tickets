@extends('layouts.user')

@section('title', 'New Ticket')

@section('contents')
<div class="container mt-5">
    <h1 class="font-bold text-2xl mb-4">Create New Ticket</h1>
    <hr/>
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('user/tickets/store') }}" method="POST">
                @csrf
                <input type="hidden" name="autorid" id="autorid" value="{{ auth()->user()->id }}">

                <div class="mb-3">
                    <label for="clasification" class="form-label">Classification</label>
                    <select id="clasification" name="clasification" class="form-select" required>
                        <option value="" disabled selected>Select one of the following issues...</option>
                        <option value="Office Failure">Office Failure</option>
                        <option value="Network Failures">Network Failures</option>
                        <option value="Software Errors">Software Errors</option>
                        <option value="Hardware Errors">Hardware Errors</option>
                        <option value="Preventive Maintenance">Preventive Maintenance</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="mb-3" id="otherField" style="display: none;">
                    <label for="other" class="form-label">Please specify</label>
                    <input type="text" id="other" name="other" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="details" class="form-label">Details</label>
                    <textarea id="details" name="details" class="form-control" rows="3" placeholder="Provide details about the issue"></textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Return</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('clasification').addEventListener('change', function() {
        var otherField = document.getElementById('otherField');
        if (this.value === 'Other') {
            otherField.style.display = 'block';
        } else {
            otherField.style.display = 'none';
        }
    });
</script>

@endsection
