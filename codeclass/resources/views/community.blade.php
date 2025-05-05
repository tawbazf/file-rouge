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

        <!-- Active Communities -->
        <section class="mb-12">
            <h2 class="text-2xl font-semibold mb-6 flex items-center">
                <i class="fas fa-fire text-orange-500 mr-2"></i> Active Communities
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach(['Web Development', 'Mobile Apps', 'Data Science', 'DevOps', 'UI/UX Design', 'Game Development'] as $index => $community)
                    <div class="community-card p-6 shadow-lg">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-xl font-semibold text-white">{{ $community }}</h3>
                            <span class="bg-blue-900 text-blue-100 text-xs px-2 py-1 rounded-full">
                                {{ rand(50, 500) }} members
                            </span>
                        </div>
                        
                        <p class="text-gray-400 mb-4">
                            Connect with fellow {{ $community }} enthusiasts, share resources, and collaborate on projects.
                        </p>
                        
                        <div class="flex -space-x-2 mb-4">
                            @for($i = 1; $i <= 5; $i++)
                                <img src="https://randomuser.me/api/portraits/{{ rand(0, 1) ? 'men' : 'women' }}/{{ rand(1, 60) }}.jpg" 
                                     class="w-8 h-8 rounded-full member-avatar" alt="Community member">
                            @endfor
                            <div class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center text-xs">+{{ rand(10, 99) }}</div>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-400">
                                <i class="fas fa-comment-alt mr-1"></i> {{ rand(5, 50) }} discussions today
                            </span>
                            
                            @auth
                                @if(rand(0, 1))
                                    <button class="text-green-400 text-sm font-medium">
                                        <i class="fas fa-check-circle mr-1"></i> Joined
                                    </button>
                                @else
                                    <form action="{{ route('community.join') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="community_id" value="{{ $index + 1 }}">
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
                @endforeach
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

            <div class="community-card p-4 shadow-lg">
                <h2 class="text-xl font-semibold text-white">Join the Discussion</h2>
                <p class="text-gray-400 mt-2">Engage in meaningful conversations with other members.</p>
                <a href="#" class="text-blue-400 hover:underline mt-4 inline-block">Start Now</a>
            </div>
        </section>
        
        <!-- Community Stats -->
        <section class="mt-12 bg-gray-800 bg-opacity-50 rounded-lg p-6">
            <h2 class="text-2xl font-semibold mb-6">Community Stats</h2>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="text-center">
                    <div class="text-3xl font-bold text-blue-400">{{ rand(1000, 5000) }}</div>
                    <div class="text-gray-400 text-sm">Members</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-purple-400">{{ rand(50, 200) }}</div>
                    <div class="text-gray-400 text-sm">Active Today</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-green-400">{{ rand(100, 500) }}</div>
                    <div class="text-gray-400 text-sm">Projects</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-yellow-400">{{ rand(10, 50) }}</div>
                    <div class="text-gray-400 text-sm">Events This Month</div>
                </div>
            </div>
        </section>

        <footer class="text-center mt-12">
            <p class="text-gray-500 text-sm">© 2025 CodeClass Community. All rights reserved.</p>
        </footer>
    </div>
    
    @auth
        <!-- Floating Chat Button -->
        <div class="fixed bottom-6 right-6">
            <button class="bg-blue-600 hover:bg-blue-700 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg">
                <i class="fas fa-comments text-xl"></i>
            </button>
        </div>
    @endauth
</body>
</html>
