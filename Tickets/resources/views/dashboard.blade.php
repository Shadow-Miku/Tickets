@extends('layouts.admin')

@section('title', 'GOD')

@section('contents')
<div class="container mt-5">
    <h1 class="font-bold text-3xl mb-4">Admin Dashboard</h1>
    <p class="lead">Bienvenido, {{ Auth::user()->name }}!</p>

    <div class="d-flex align-items-center mb-4">
        <img src="{{ asset('storage/' . Auth::user()->url) }}" alt="Profile" class="rounded-circle me-3" style="height: 70px; width: 70px;">
        <div>
            <h4 class="fw-bold">{{ Auth::user()->name }}</h4>
            <p class="text-muted">Administrator</p>
        </div>
    </div>

    <div class="row">
        <!-- Card for Total Users -->
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3 shadow">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text fs-2 fw-bold">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>

        <!-- Card for Total Tickets -->
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3 shadow">
                <div class="card-body">
                    <h5 class="card-title">Total Tickets</h5>
                    <p class="card-text fs-2 fw-bold">{{ $totalTickets }}</p>
                </div>
            </div>
        </div>

        <!-- Card for Assigned Tickets -->
        <div class="col-md-4">
            <div class="card text-white bg-danger mb-3 shadow">
                <div class="card-body">
                    <h5 class="card-title">Asigned Tickets</h5>
                    <p class="card-text fs-2 fw-bold">{{ $assignedTickets }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Card for Pending Tickets -->
        <div class="col-md-6">
            <div class="card text-white bg-warning mb-3 shadow">
                <div class="card-body">
                    <h5 class="card-title">Pending Tickets</h5>
                    <p class="card-text fs-2 fw-bold">{{ $pendingTickets }}</p>
                </div>
            </div>
        </div>

        <!-- Card for Resolved Tickets -->
        <div class="col-md-6">
            <div class="card text-white bg-info mb-3 shadow">
                <div class="card-body">
                    <h5 class="card-title">Resolved Tickets</h5>
                    <p class="card-text fs-2 fw-bold">{{ $resolvedTickets }}</p>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection
