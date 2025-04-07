<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centre de Notifications</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .notification-urgent {
            border-left: 4px solid #ef4444;
            background-color: #fee2e2;
        }
        .notification-success {
            border-left: 4px solid #10b981;
            background-color: #ecfdf5;
        }
        .notification-info {
            border-left: 4px solid #3b82f6;
            background-color: #eff6ff;
        }
        .notification-warning {
            border-left: 4px solid #f59e0b;
            background-color: #fffbeb;
        }
        .notification-default {
            border-left: 4px solid #6b7280;
            background-color: #f3f4f6;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="max-w-4xl mx-auto my-8 bg-white rounded-lg shadow-md">
        <!-- Header -->
        <div class="flex items-center justify-between p-4 border-b border-gray-200">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <h1 class="text-xl font-semibold text-gray-900">Centre de Notifications</h1>
            </div>
            <div class="flex items-center space-x-2">
                <button class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </button>
                <button class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Tabs -->
        <div class="flex border-b border-gray-200 px-4">
            <button class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-t-md">
                Toutes
            </button>
            <button class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100">
                Non lues
            </button>
            <button class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100">
                Importantes
            </button>
        </div>

        <!-- Notifications List -->
        <div class="divide-y divide-gray-200">
            <!-- Notification Urgente -->
            <div class="notification-urgent p-4 relative">
                <button class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <div class="flex">
                    <div class="flex-shrink-0 mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-red-800">Urgent: Échéance Projet</h3>
                        <p class="mt-1 text-sm text-gray-700">Le projet "Interface Mobile" doit être livré dans 24 heures.</p>
                        <p class="mt-1 text-xs text-red-600">Il y a 10 minutes</p>
                    </div>
                </div>
            </div>

            <!-- Notification Validation -->
            <div class="notification-success p-4 relative">
                <button class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <div class="flex">
                    <div class="flex-shrink-0 mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-green-800">Validation Réussie</h3>
                        <p class="mt-1 text-sm text-gray-700">Votre rapport mensuel a été approuvé par le chef de projet.</p>
                        <p class="mt-1 text-xs text-green-600">Il y a 1 heure</p>
                    </div>
                </div>
            </div>

            <!-- Notification Collaboration -->
            <div class="notification-info p-4 relative">
                <button class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <div class="flex">
                    <div class="flex-shrink-0 mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-blue-800">Nouvelle Collaboration</h3>
                        <p class="mt-1 text-sm text-gray-700">Marie Dubois vous a ajouté au projet "Refonte UX".</p>
                        <p class="mt-1 text-xs text-blue-600">Il y a 3 heures</p>
                    </div>
                </div>
            </div>

            <!-- Notification Rappel -->
            <div class="notification-warning p-4 relative">
                <button class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <div class="flex">
                    <div class="flex-shrink-0 mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-yellow-800">Rappel: Réunion</h3>
                        <p class="mt-1 text-sm text-gray-700">Réunion d'équipe hebdomadaire dans 30 minutes.</p>
                        <p class="mt-1 text-xs text-yellow-600">Il y a 4 heures</p>
                    </div>
                </div>
            </div>

            <!-- Notification Message -->
            <div class="notification-default p-4 relative">
                <button class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <div class="flex">
                    <div class="flex-shrink-0 mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-800">Nouveau Message</h3>
                        <p class="mt-1 text-sm text-gray-700">Thomas a commenté sur votre dernier rapport.</p>
                        <p class="mt-1 text-xs text-gray-600">Il y a 5 heures</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="px-4 py-3 bg-gray-50 text-sm flex justify-between items-center rounded-b-lg">
            <span class="text-gray-600">Notifications des dernières 24 heures</span>
            <a href="#" class="text-blue-600 hover:text-blue-800">Voir toutes les notifications</a>
        </div>
    </div>

    <script>
        // Script pour fermer les notifications
        document.addEventListener('DOMContentLoaded', function() {
            const closeButtons = document.querySelectorAll('.notification-urgent button, .notification-success button, .notification-info button, .notification-warning button, .notification-default button');
            
            closeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const notification = this.closest('div[class^="notification-"]');
                    notification.style.display = 'none';
                });
            });
        });
    </script>
</body>
</html>