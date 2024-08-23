<!DOCTYPE html>
<html lang="en">
{{-- Admin Layout --}}
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
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Import JS, Styles and icon -->
    <script src="{{ asset('js/admin.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/adminMenu.css') }}">
    <link rel="icon" href="{{ asset('img/arengee_penetrael_dgr_icon.ico') }}" type="image/x-icon">

</head>

<body>
    <!-- TOP MENU -->
    <header class="px-4 py-2 shadow-sm bg-light">
        <div class="d-flex justify-content-between align-items-center">
            <!-- Sidebar Toggle Button -->
            <button class="btn btn-outline-dark" data-bs-toggle="offcanvas" data-bs-target="#sidebar">
                <i class="bi bi-list"></i>
            </button>

            <div class="d-flex align-items-center">
                <!-- Messages Button -->
                <button class="btn btn-light position-relative me-2">
                    <i class="bi bi-envelope-fill"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span>
                </button>
                <!-- Notifications Button -->
                <button class="btn btn-light position-relative me-3">
                    <i class="bi bi-bell-fill"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">5</span>
                </button>
                <!-- User Dropdown -->
                <div class="btn-group">
                    <!-- Profile image button (deploys modal) -->
                    <button type="button" class="btn" id="profileImageButton">
                        <img src="{{ asset('storage/' . Auth::user()->url) }}" alt="Profile Image" class="rounded-circle" width="40" height="40">
                    </button>

                    <!-- Dropdown button (deployed by name) -->
                    <button type="button" class="btn dropdown-toggle dropdown-toggle-split d-flex align-items-center" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="me-2 d-none d-md-inline-block text-black">{{ auth()->user()->name }}</span>
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
    </header>

    <!-- Modal for Profile Image -->
    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">
                <div class="modal-body text-center">
                    <div class="position-relative d-inline-block">
                        <!-- Enlarged Profile Image acting as a button -->
                        <a href="{{ route('admin/profile') }}">
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

    <!-- SIDEBAR -->
    <div class="d-flex">
        <!-- Offcanvas Sidebar -->
        <div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="sidebarLabel">Admin</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body p-0">
                <ul class="list-group list-group-flush">
                    <!-- Home -->
                    <li class="list-group-item bg-dark border-0 mb-2">
                        <a href="{{ route('admin/home') }}" class="text-white d-flex align-items-center py-3 px-4 rounded hover-effect @if(Route::currentRouteName() == 'admin/home') active-link @endif">
                            <i class="bi bi-house-door-fill me-3"></i> Home
                        </a>
                    </li>
                    <!-- Users -->
                    <li class="list-group-item bg-dark border-0 mb-2">
                        <a href="{{ route('admin/users') }}" class="text-white d-flex align-items-center py-3 px-4 rounded hover-effect @if(Route::currentRouteName() == 'admin/users') active-link @endif">
                            <i class="bi bi-people me-3"></i> Users
                        </a>
                    </li>
                    <!-- Divisions -->
                    <li class="list-group-item bg-dark border-0 mb-2">
                        <a href="{{ route('admin/divisions') }}" class="text-white d-flex align-items-center py-3 px-4 rounded hover-effect @if(Route::currentRouteName() == 'admin/divisions') active-link @endif">
                            <i class='bx bxs-pyramid me-3'></i> Divisions
                        </a>
                    </li>
                    <!-- Tickets Dropdown -->
                    <li class="list-group-item bg-dark border-0 mb-2">
                        <a href="#ticketsSubmenu" class="text-white d-flex align-items-center py-3 px-4 rounded hover-effect dropdown-toggle @if(Route::currentRouteName() == 'admin/tickets' || Route::currentRouteName() == 'admin/assigned-tickets') active-link @endif" data-bs-toggle="collapse" role="button" aria-expanded="false">
                            <i class='bx bx-receipt me-3'></i> Tickets
                        </a>
                        <div class="collapse @if(Route::currentRouteName() == 'admin/tickets' || Route::currentRouteName() == 'admin/assigned-tickets') show @endif" id="ticketsSubmenu">
                            <ul class="list-group list-group-flush">
                                <!-- All Registered Tickets -->
                                <li class="list-group-item bg-dark border-0">
                                    <a href="{{ route('admin/assignedtickets') }}" class="text-white d-flex align-items-center py-2 px-4 rounded hover-effect @if(Route::currentRouteName() == 'admin/assignedtickets') active-link @endif">
                                        <i class="bi bi-clipboard-check me-3"></i> Tickets
                                    </a>
                                </li>
                                <!-- Generate pdf of specific Tickets -->
                                <li class="list-group-item bg-dark border-0 mb-2">
                                    <a href="#" class="text-white d-flex align-items-center py-2 px-4 rounded hover-effect @if(Route::currentRouteName() == '#') active-link @endif">
                                        <i class="bi bi-file-pdf me-3"></i> Tickets PDF
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- Profile -->
                    <li class="list-group-item bg-dark border-0 mb-2">
                        <a href="{{ route('admin/profile') }}" class="text-white d-flex align-items-center py-3 px-4 rounded hover-effect @if(Route::currentRouteName() == 'admin/profile') active-link @endif">
                            <i class='bx bxs-user-account me-3'></i> Profile
                        </a>
                    </li>
                    <!-- Logout -->
                    <li class="list-group-item bg-dark border-0">
                        <a href="{{ route('logout') }}" class="text-white d-flex align-items-center py-3 px-4 rounded hover-effect">
                            <i class="bi bi-box-arrow-in-right me-3"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- CONTENTS -->
        <div class="flex-grow-1 p-4">
            <div>@yield('contents')</div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js (Include these scripts at the end of your body) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>

</body>

</html>
