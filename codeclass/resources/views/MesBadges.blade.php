<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Badges | Codeclass</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .badge-card {
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .badge-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center">
                    <h1 class="text-3xl font-bold text-gray-900">Mes Badges</h1>
                    <a href="{{ route('badge.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Créer un badge
                    </a>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p class="font-bold">Succès !</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="px-4 py-6 sm:px-0">
                @if($badges->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach($badges as $badge)
                            <div class="badge-card bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg">
                                <div class="p-6">
                                    <div class="flex flex-col items-center text-center">
                                        <div class="w-32 h-32 rounded-full flex items-center justify-center mb-4 {{ $badge->color ?? 'bg-blue-500' }}">
                                            <span class="text-white text-4xl font-bold">{{ substr($badge->name, 0, 1) }}</span>
                                        </div>
                                        <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $badge->name }}</h3>
                                        <p class="text-sm text-gray-600 mb-3">{{ $badge->description ?? 'Aucune description' }}</p>
                                        <div class="flex items-center text-sm text-gray-500">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                            </svg>
                                            {{ $badge->created_at->diffForHumans() }}
                                        </div>
                                        @if(isset($badge->points))
                                            <div class="mt-2 px-3 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">
                                                {{ $badge->points }} points
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="bg-gray-50 px-4 py-3 text-right">
                                    <a href="{{ route('badge.show', $badge->id) }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">
                                        Voir les détails
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($badges->hasPages())
                        <div class="mt-8">
                            {{ $badges->links() }}
                        </div>
                    @endif
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Aucun badge trouvé</h3>
                        </div>
                    </div>
                @endif
            </div>
        </main>
    </div>
</body>
</html>