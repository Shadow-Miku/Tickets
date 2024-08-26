@extends('layouts.user')

@section('title', 'Home')

@section('contents')
<header class="bg-white shadow-sm">
    <div class="container py-4">
        <h1 class="text-3xl font-bold text-gray-900">Home</h1>
    </div>
</header>

<hr />

<main>
    <div class="container mt-4">
        <!-- Welcome Section -->
        <div class="d-flex align-items-center mb-4">
            <img src="{{ asset('storage/' . Auth::user()->url) }}" alt="Profile" class="rounded-circle me-3" style="height: 70px; width: 70px; object-fit: cover">
            <div>
                <h4 class="fw-bold">Bienvenido, {{ Auth::user()->name }}!</h4>
                <p class="text-muted">Usuario</p>
            </div>
        </div>
    </div>
</main>
@endsection
