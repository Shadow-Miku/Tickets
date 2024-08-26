@extends('layouts.assistant')

@section('title', 'Celebrated Peon')

@section('contents')
<div class="container mt-5">
    <h1 class="font-bold text-3xl mb-4">Assistant Dashboard</h1>
    <p class="lead">Welcome, {{ Auth::user()->name }}!</p>

    <div class="d-flex align-items-center mb-4">
        <img src="{{ asset('storage/' . Auth::user()->url) }}" alt="Profile" class="rounded-circle me-3" style="height: 70px; width: 70px; object-fit: cover">
        <div>
            <h4 class="fw-bold">{{ Auth::user()->name }}</h4>
            <p class="text-muted">Assistant</p>
        </div>
    </div>

    <div class="row">
        <!-- Card for Assigned Tickets -->
        <div class="col-md-6">
            <div class="card text-white bg-primary mb-3 shadow">
                <div class="card-body">
                    <h5 class="card-title">Assigned Tickets</h5>
                    <p class="card-text fs-2 fw-bold">{{ $assignedTickets }}</p>
                </div>
            </div>
        </div>

        <!-- Card for Pending Tickets -->
        <div class="col-md-6">
            <div class="card text-white bg-warning mb-3 shadow">
                <div class="card-body">
                    <h5 class="card-title">Pending Tickets</h5>
                    <p class="card-text fs-2 fw-bold">{{ $pendingTickets }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Card for Completed Tickets -->
        <div class="col-md-6">
            <div class="card text-white bg-success mb-3 shadow">
                <div class="card-body">
                    <h5 class="card-title">Resolved Tickets</h5>
                    <p class="card-text fs-2 fw-bold">{{ $resolvedTickets }}</p>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection
