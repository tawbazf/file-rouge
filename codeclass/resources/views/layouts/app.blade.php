<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Codeclass - @yield('title', 'Plateforme d\'apprentissage')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @yield('styles')
</head>
<body>
    <div class="d-flex flex-column min-vh-100">
        <header class="bg-white border-bottom">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center py-3">
                    <a href="{{ url('/') }}" class="text-decoration-none">
                        <h1 class="h4 m-0 text-primary">Codeclass</h1>
                    </a>
                    <div class="d-flex align-items-center">
                        <!-- Navigation Links -->
                        <nav class="d-none d-md-flex me-4">
                            <a href="{{ route('dashboard') }}" class="text-decoration-none me-3">Dashboard</a>
                            <a href="{{ route('code.review') }}" class="text-decoration-none me-3">Code Review</a>
                            <a href="{{ route('general.statistics') }}" class="text-decoration-none me-3">Statistics</a>
                            <a href="{{ route('badges.index') }}" class="text-decoration-none me-3">Badges</a>
                            <a href="{{ url('/skills/all') }}" class="text-decoration-none me-3">Skills</a>
                        </nav>
                        
                        <a href="#" class="position-relative me-3">
                            <i class="fas fa-bell fs-5"></i>
                        </a>
                        <div class="dropdown">
                            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ auth()->user()->avatar ?? 'https://via.placeholder.com/32' }}" class="rounded-circle" width="32" height="32" alt="User">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="#">Mon profil</a></li>
                                <li><a class="dropdown-item" href="#">Paramètres</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Déconnexion</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="container py-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </main>

        <footer class="border-top py-4 mt-auto">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p class="text-muted mb-md-0">© 2025 codeclass. Tous droits réservés.</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <a href="#" class="text-muted me-3">Aide</a>
                        <a href="#" class="text-muted me-3">Conditions</a>
                        <a href="#" class="text-muted">Confidentialité</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
