@extends('layouts.admin')

@section('title', 'Divisions')

@section('contents')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Actual Divisions</h1>
        <a href="{{ route('admin/divisions/create') }}" class="btn btn-primary">New Division</a>
    </div>
    <hr class="mb-4"/>

    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @if($division->count() > 0)
                @foreach($division as $dv)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $dv->name }}</td>
                    <td class="w-25">
                        <div class="btn-group" role="group">
                            <a href="{{ route('admin/divisions/edit', $dv->id)}}" class="btn btn-success btn-sm">Edit</a>
                            <form action="{{ route('admin/divisions/destroy', $dv->id) }}" method="POST" onsubmit="return confirm('Delete?')" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="3">No Divisions registered</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
