<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeClass Certifications</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700&family=Poppins:wght@300;400;500;600;700&display=swap">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            min-height: 100vh;
        }
        
        .title-font {
            font-family: 'Orbitron', sans-serif;
        }
        
        .certification-card {
            background: linear-gradient(to-br, #1e293b, #374151);
            border-radius: 0.5rem;
            border: 1px solid #4b5563;
        }
    </style>
</head>
<body class="text-gray-200">
    <div class="container mx-auto p-6">
        <header class="text-center mb-8">
            <h1 class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-600 title-font">
                <i class="fas fa-certificate mr-2" aria-hidden="true"></i> CodeClass Certifications
            </h1>
            <p class="text-lg text-gray-400 mt-2">Showcase your achievements</p>
        </header>

        <div class="mb-6 flex flex-wrap gap-3">
            <button class="filter-btn bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-medium" aria-pressed="true" data-filter="all">All Certifications</button>
            <button class="filter-btn bg-gray-700 text-gray-300 px-3 py-1 rounded-full text-sm" aria-pressed="false" data-filter="laravel">Laravel</button>
            <button class="filter-btn bg-gray-700 text-gray-300 px-3 py-1 rounded-full text-sm" aria-pressed="false" data-filter="frontend">Frontend</button>
            <button class="filter-btn bg-gray-700 text-gray-300 px-3 py-1 rounded-full text-sm" aria-pressed="false" data-filter="database">Database</button>
        </div>

        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="certifications-container">
            @forelse($certifications as $certification)
                <div class="certification-card p-5 shadow-lg relative" data-type="{{ str_contains(strtolower($certification->title), 'laravel') ? 'laravel' : (str_contains(strtolower($certification->title), 'frontend') ? 'frontend' : 'database') }}">
                    <div class="mt-2">
                        <h2 class="text-xl font-semibold text-white">{{ $certification->title }}</h2>
                        <p class="text-gray-400 mb-4 line-clamp-3">Earned on {{ \Carbon\Carbon::parse($certification->date)->format('F j, Y') }}</p>
                        
                        <div class="flex flex-wrap gap-1 mb-4">
                            <span class="bg-gray-700 text-gray-300 text-xs px-2 py-1 rounded">Certification</span>
                            <span class="bg-gray-700 text-gray-300 text-xs px-2 py-1 rounded">{{ str_contains(strtolower($certification->title), 'laravel') ? 'Laravel' : (str_contains(strtolower($certification->title), 'frontend') ? 'Frontend' : 'Database') }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <i class="fas fa-user text-blue-400 mr-1" aria-hidden="true"></i>
                                <span class="text-gray-400 text-sm">User {{ $certification->user_id }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-award text-yellow-400 mr-1" aria-hidden="true"></i>
                                <span class="text-gray-400 text-sm">Certified</span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-400 text-center col-span-full">No certifications found.</p>
            @endforelse
        </section>

        <footer class="text-center mt-12">
            <p class="text-gray-500 text-sm">© 2025 CodeClass Community. All rights reserved.</p>
        </footer>
    </div>

    <script>
        // Filter button interactivity
        document.querySelectorAll('.filter-btn').forEach(button => {
            button.addEventListener('click', () => {
                // Update button styles and aria-pressed
                document.querySelectorAll('.filter-btn').forEach(btn => {
                    btn.classList.replace('bg-blue-600', 'bg-gray-700');
                    btn.classList.replace('text-white', 'text-gray-300');
                    btn.setAttribute('aria-pressed', 'false');
                });
                button.classList.replace('bg-gray-700', 'bg-blue-600');
                button.classList.replace('text-gray-300', 'text-white');
                button.setAttribute('aria-pressed', 'true');

                // Filter certifications
                const filter = button.dataset.filter;
                const cards = document.querySelectorAll('.certification-card');
                cards.forEach(card => {
                    if (filter === 'all' || card.dataset.type === filter) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>