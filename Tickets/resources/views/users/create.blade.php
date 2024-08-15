@extends('layouts.admin')

@section('title', 'New User')

@section('contents')
<div class="container mt-5">
    <h1 class="text-3xl font-bold mb-4">New User</h1>
    <form action="{{ route('admin/users/store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-3">
            <!-- Left column: Form -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="name" class="form-label" style="font-weight: bold;">Full Name</label>
                    <input id="name" name="name" type="text" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label" style="font-weight: bold;">Email</label>
                    <input id="email" name="email" type="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label" style="font-weight: bold;">Password</label>
                    <input id="password" name="password" type="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="type" class="form-label" style="font-weight: bold;">User Type</label>
                    <select id="type" name="type" class="form-select" required>
                        <option value="0">User</option>
                        <option value="1">Admin</option>
                        <option value="2">Assistant</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="divisionid" class="form-label" style="font-weight: bold;">Division</label>
                    <select id="divisionid" name="divisionid" class="form-select" required>
                        @foreach($division as $div)
                        <option value="{{ $div->id }}" data-description="{{ $div->name }}">{{ $div->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="url" class="form-label" style="font-weight: bold;">Image</label>
                    <input type="file" id="url" name="url" class="form-control" onchange="previewImage(this)">
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <a id="backButton" href="{{ url()->previous() }}" class="btn btn-secondary">Return</a>
                </div>
            </form>
        </div>

        <!-- Right Column: Image preview -->
        <div class="col-md-6">
            <label class="form-label" style="font-weight: bold;">Preview</label>
            <div>
                <img id="imagePreview" src="" class="img-fluid rounded border border-secondary">
            </div>
        </div>
    </div>
</div>

@endsection
