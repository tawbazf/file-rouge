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
        </header>

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

        <footer class="text-center mt-12">
            <p class="text-gray-500 text-sm">© 2025 CodeClass Community. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>