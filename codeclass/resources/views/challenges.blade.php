<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeClass Challenges</title>
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
        
        .challenge-card {
            background: linear-gradient(to-br, #1e293b, #374151);
            border-radius: 0.5rem;
            border: 1px solid #4b5563;
        }
        
        .difficulty-badge {
            position: absolute;
            top: -10px;
            right: -10px;
            z-index: 10;
        }
    </style>
</head>
<body class="text-gray-200">
    <div class="container mx-auto p-6">
        <div class="flex justify-between items-center mb-10">
            <h1 class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-600 title-font">
                <i class="fas fa-trophy mr-2" aria-hidden="true"></i> CodeClass Challenges
            </h1>
        </div>
        
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if(session('info'))
            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-6" role="alert">
                <p>{{ session('info') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <p>{{ session('error') }}</p>
            </div>
        @endif
        
        <div class="mb-6 flex flex-wrap gap-3">
            <button class="filter-btn bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-medium" aria-pressed="true" data-filter="all">All Challenges</button>
            <button class="filter-btn bg-gray-700 text-gray-300 px-3 py-1 rounded-full text-sm" aria-pressed="false" data-filter="completed">Completed</button>
            <button class="filter-btn bg-gray-700 text-gray-300 px-3 py-1 rounded-full text-sm" aria-pressed="false" data-filter="in_progress">In Progress</button>
            <button class="filter-btn bg-gray-700 text-gray-300 px-3 py-1 rounded-full text-sm" aria-pressed="false" data-filter="not_started">Not Started</button>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="challenges-container">
            @forelse($challenges as $challenge)
                <div class="challenge-card p-5 shadow-lg relative" data-status="{{ $challenge->status }}">
                    <div class="difficulty-badge {{ $challenge->status === 'completed' ? 'bg-green-500' : ($challenge->status === 'in_progress' ? 'bg-yellow-500' : 'bg-red-500') }} text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                        {{ ucfirst(str_replace('_', ' ', $challenge->status)) }}
                    </div>
                    
                    <div class="mt-2">
                        <h2 class="text-xl font-semibold text-white">{{ $challenge->title }}</h2>
                        <p class="text-gray-400 mb-4 line-clamp-3">Started on {{ \Carbon\Carbon::parse($challenge->date)->format('F j, Y') }}</p>
                        
                        <div class="flex flex-wrap gap-1 mb-4">
                            <span class="bg-gray-700 text-gray-300 text-xs px-2 py-1 rounded">Challenge</span>
                            <span class="bg-gray-700 text-gray-300 text-xs px-2 py-1 rounded">{{ $challenge->status === 'completed' ? 'Done' : 'Active' }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <i class="fas fa-user text-blue-400 mr-1" aria-hidden="true"></i>
                                <span class="text-gray-400 text-sm">User {{ $challenge->user_id }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-award text-yellow-400 mr-1" aria-hidden="true"></i>
                                <span class="text-gray-400 text-sm">100 points</span>
                            </div>
                        </div>
                        
                        <!-- Bouton pour participer au challenge -->
                        <div class="mt-4">
                            @auth
                                @if(isset($challenge->participants) && $challenge->hasParticipant(Auth::id()))
                                    <!-- L'utilisateur participe déjà, afficher le formulaire de mise à jour du statut -->
                                    <form action="{{ route('challenges.updateStatus', $challenge->id) }}" method="POST" class="mt-2">
                                        @csrf
                                        @method('PUT')
                                        <div class="flex items-center space-x-2">
                                            <select name="status" class="bg-gray-700 text-white text-sm rounded px-2 py-1">
                                                <option value="not_started" {{ $challenge->participants->where('id', Auth::id())->first()->pivot->status === 'not_started' ? 'selected' : '' }}>Non commencé</option>
                                                <option value="in_progress" {{ $challenge->participants->where('id', Auth::id())->first()->pivot->status === 'in_progress' ? 'selected' : '' }}>En cours</option>
                                                <option value="completed" {{ $challenge->participants->where('id', Auth::id())->first()->pivot->status === 'completed' ? 'selected' : '' }}>Terminé</option>
                                            </select>
                                            <button type="submit" class="bg-blue-600 text-white text-sm px-3 py-1 rounded">
                                                Mettre à jour
                                            </button>
                                        </div>
                                    </form>
                                @else
                                    <!-- L'utilisateur ne participe pas encore, afficher le bouton pour participer -->
                                    <form action="{{ route('challenges.participate', $challenge->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md">
                                            Participer au challenge
                                        </button>
                                    </form>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="block text-center w-full bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-md">
                                    Connectez-vous pour participer
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-400 text-center col-span-full">No challenges found.</p>
            @endforelse
        </div>
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

                // Filter challenges
                const filter = button.dataset.filter;
                const cards = document.querySelectorAll('.challenge-card');
                cards.forEach(card => {
                    if (filter === 'all' || card.dataset.status === filter) {
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
