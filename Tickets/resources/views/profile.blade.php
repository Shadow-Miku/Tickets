@extends('layouts.admin')

@section('title', 'Profile Settings')

@section('contents')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-4">Edit Info</h1>
    <form action="{{ route('admin/profile/update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row g-3">
            <!-- Left Column: Form -->
            <div class="col-md-6">

                <div class="mb-3">
                    <label for="name" class="form-label" style="font-weight: bold;">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label" style="font-weight: bold;">Password (leave blank if not changing)</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label" style="font-weight: bold;">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                </div>


                <div class="mb-3">
                    <label for="url" class="form-label" style="font-weight: bold;">Image</label>
                    <input type="file" id="url" name="url" class="form-control" onchange="previewImage(this)">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </div>

            <!-- Right Column: Image Preview -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label id="imageLabel" class="form-label" style="font-weight: bold;">Current Image</label>
                    <br>
                    <img id="imagePreview" src="{{ asset('storage/' . $user->url) }}" alt="Current Image" class="img-fluid rounded border">
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function previewImage(input) {
        const file = input.files[0];
        const preview = document.getElementById('imagePreview');
        const label = document.getElementById('imageLabel');
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                label.textContent = 'Preview'; // Cambia el texto a "Preview"
            };
            reader.readAsDataURL(file);
        }
    }

    document.addEventListener('DOMContentLoaded', function() { style="font-weight: bold;"
        const preview = document.getElementById('imagePreview');
        preview.src = "{{ asset('storage/' . $user->url) }}";
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Obtener el select y el valor de tipo del data attribute
        const select = document.getElementById('type');
        const typeValue = select.getAttribute('data-selected-value');

        // Condición directa para seleccionar la opción correcta
        if (typeValue === 'admin') {
            select.value = '1';
        } else if (typeValue === 'assistant') {
            select.value = '2';
        } else if (typeValue === 'user') {
            select.value = '0';
        }
    });
</script>
@endsection
