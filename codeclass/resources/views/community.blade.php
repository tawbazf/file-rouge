<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeClass Community</title>
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
        
        .community-card {
            background: linear-gradient(to-br, #1e293b, #374151);
            border-radius: 0.5rem;
            border: 1px solid #4b5563;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .community-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
        }
        
        .btn-join {
            background: linear-gradient(to right, #3b82f6, #8b5cf6);
            transition: all 0.3s ease;
        }
        
        .btn-join:hover {
            background: linear-gradient(to right, #2563eb, #7c3aed);
            transform: translateY(-2px);
        }
        
        .member-avatar {
            border: 2px solid #4b5563;
            transition: transform 0.2s ease;
        }
        
        .member-avatar:hover {
            transform: scale(1.1);
            z-index: 10;
        }
    </style>
</head>
<body class="text-gray-200">
    <div class="container mx-auto p-6">
        <header class="text-center mb-8">
            <h1 class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-600 title-font">
                <i class="fas fa-users mr-2" aria-hidden="true"></i> Welcome to the CodeClass Community
            </h1>
            <p class="text-lg text-gray-400 mt-2">Connect, share, and grow together</p>
            
            @auth
                <div class="mt-4">
                    <span class="bg-green-800 text-green-100 px-3 py-1 rounded-full text-sm">
                        <i class="fas fa-check-circle mr-1"></i> You're a member
                    </span>
                </div>
            @else
                <div class="mt-6">
                    <a href="{{ route('register') }}" class="btn-join text-white font-medium px-6 py-3 rounded-lg shadow-lg">
                        <i class="fas fa-user-plus mr-2"></i> Join Our Community
                    </a>
                </div>
            @endauth
        </header>

        <!-- Display success/error messages -->
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

        <!-- Active Communities -->
        <section class="mb-12">
            <h2 class="text-2xl font-semibold mb-6 flex items-center">
                <i class="fas fa-fire text-orange-500 mr-2"></i> Active Communities
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($communities as $community)
                    <div class="community-card p-6 shadow-lg">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-xl font-semibold text-white">{{ $community->name }}</h3>
                            <span class="bg-blue-900 text-blue-100 text-xs px-2 py-1 rounded-full">
                                {{ $community->member_count }} members
                            </span>
                        </div>
                        
                        <p class="text-gray-400 mb-4">
                            {{ $community->description }}
                        </p>
                        
                        <div class="flex -space-x-2 mb-4">
                            @php $displayedUsers = 0; @endphp
                            @foreach($randomUsers->shuffle()->take(5) as $user)
                                @php $displayedUsers++; @endphp
                                <img src="https://randomuser.me/api/portraits/{{ rand(0, 1) ? 'men' : 'women' }}/{{ rand(1, 60) }}.jpg" 
                                     class="w-8 h-8 rounded-full member-avatar" alt="Community member">
                            @endforeach
                            @if($community->member_count > $displayedUsers)
                                <div class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center text-xs">
                                    +{{ $community->member_count - $displayedUsers }}
                                </div>
                            @endif
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-400">
                                <i class="fas fa-comment-alt mr-1"></i> {{ $community->discussion_count }} discussions
                            </span>
                            
                            @auth
                                @if($community->isMember(auth()->id()))
                                    <form action="{{ route('community.leave') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="community_id" value="{{ $community->id }}">
                                        <button type="submit" class="text-green-400 text-sm font-medium">
                                            <i class="fas fa-check-circle mr-1"></i> Joined
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('community.join') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="community_id" value="{{ $community->id }}">
                                        <button type="submit" class="text-blue-400 hover:text-blue-300 text-sm font-medium">
                                            <i class="fas fa-plus-circle mr-1"></i> Join
                                        </button>
                                    </form>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-300 text-sm font-medium">
                                    <i class="fas fa-sign-in-alt mr-1"></i> Login to join
                                </a>
                            @endauth
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <i class="fas fa-users text-gray-600 text-5xl mb-4"></i>
                        <h3 class="text-xl font-semibold mb-2">No communities found</h3>
                        <p class="text-gray-400">Be the first to create a community!</p>
                    </div>
                @endforelse
            </div>
        </section>

        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="community-card p-4 shadow-lg">
                <h2 class="text-xl font-semibold text-white">Community Guidelines</h2>
                <p class="text-gray-400 mt-2">Learn about our rules and values to maintain a positive environment.</p>
                <a href="#" class="text-blue-400 hover:underline mt-4 inline-block">Read More</a>
            </div>

            <div class="community-card p-4 shadow-lg">
                <h2 class="text-xl font-semibold text-white">Upcoming Events</h2>
                <p class="text-gray-400 mt-2">Stay updated with the latest events and activities in our community.</p>
                <a href="#" class="text-blue-400 hover:underline mt-4 inline-block">View Events</a>
            </div>