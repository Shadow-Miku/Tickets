<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <!-- Import Bootstrap CSS and JS for modals -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Import Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <!-- Import JS, Styles and icon -->
    <script src="{{ asset('js/user.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/userMenu.css') }}">
    <link rel="icon" href="{{ asset('img/IconoPrin.ico') }}" type="image/x-icon">
</head>

<body>
    <!-- TOP MENU -->
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">F.R.E.S.H</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ url('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('user/tickets') }}">Tickets</a>
                        </li>
                    </ul>
                    <div class="btn-group">
                        <!-- Profile image button (deploys modal) -->
                        <button type="button" class="btn" id="profileImageButton">
                            <img src="{{ asset('storage/' . Auth::user()->url) }}" alt="Profile Image" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover">
                        </button>

                        <!-- Dropdown button (deployed by name) -->
                        <button type="button" class="btn dropdown-toggle dropdown-toggle-split d-flex align-items-center" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="me-2 d-inline-block text-white">{{ auth()->user()->name }}</span>
                        </button>

                        <!-- Deployed menu -->
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" @disabled(true)><i class="bi bi-gear-fill me-2"></i>Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="{{ route('logout') }}"><i class="bi bi-box-arrow-right me-2"></i>Log out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Modal for Profile Image -->
        <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-3">
                    <div class="modal-body text-center">
                        <div class="position-relative d-inline-block">
                            <!-- Enlarged Profile Image acting as a button -->
                            <a href="{{ route('profile') }}">
                                <img src="{{ asset('storage/' . Auth::user()->url) }}" alt="Profile Image" class="rounded-circle img-fluid profile-image">
                                <!-- Hover effect for Edit Profile -->
                                <div class="position-absolute top-50 start-50 translate-middle text-white d-none" style="transform: translate(-50%, -50%);">
                                    <i class="bi bi-pencil-fill"></i> Edit Profile
                                </div>
                            </a>
                        </div>
                        <!-- User Name -->
                        <p class="mt-3 fs-4 user-name">{{ auth()->user()->name }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <main class="container my-4">
            <div>@yield('contents')</div>
        </main>
    </div>


</body>


</html>
