@extends('layouts.admin')

@section('title', 'GOD')

@section('contents')
<div>
    <h1 class="font-bold text-2xl ml-3">Dashboard</h1>

    Bienvenido {{ Auth::user()->name }} !!!

    <img src="{{ asset('storage/' . Auth::user()->url) }}"alt="Profle" class="h-16 rounded-full">


</div>
@endsection
