@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md">
    <!-- Header -->
    <div class="flex items-center justify-between p-4">
        <div class="flex items-center">
        
            <h1 class="text-xl font-medium text-gray-900">Centre de Notifications</h1>
        </div>
        <div class="flex items-center space-x-2">
            <button class="text-gray-500 hover:text-gray-700">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </button>
            <button class="text-gray-500 hover:text-gray-700">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Tabs -->
    <div class="flex">
        <a href="#" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium">
            Toutes
        </a>
        <a href="#" class="px-4 py-2 text-gray-600 hover:bg-gray-100 text-sm font-medium">
            Non lues
        </a>
        <a href="#" class="px-4 py-2 text-gray-600 hover:bg-gray-100 text-sm font-medium">
            Importantes
        </a>
    </div>

    <!-- Notifications List -->
    <div>
        @if(count($notifications))
            @foreach($notifications as $notification)
                @php
                    $type = $notification['type'] ?? 'default';
                @endphp
                
                <div class="notification-item notification-{{ $type }}" data-id="{{ $notification['id'] ?? '' }}">
                    <button class="close-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <div class="notification-content">
                        <div class="notification-icon">
                            @if($type == 'urgent')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            @elseif($type == 'success')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            @elseif($type == 'info')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            @elseif($type == 'warning')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            @endif
                        </div>
                        <div class="notification-text">
                            <h3>{{ $notification['title'] }}</h3>
                            <p>{{ $notification['message'] }}</p>
                            <span>{{ $notification['time'] }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="p-8 text-center text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                </svg>
                <p class="text-lg">Aucune notification à afficher.</p>
                <p class="mt-2">Vous serez notifié lorsque de nouvelles activités se produiront.</p>
            </div>
        @endif
    </div>
    @foreach(auth()->user()->unreadNotifications as $notification)
    <div>
        <strong>{{ $notification->data['title'] }}</strong><br>
        {{ $notification->data['message'] }}<br>
        <a href="{{ url('/assignments/' . $notification->data['assignment_id']) }}">Voir</a>
    </div>
@endforeach

    <!-- Footer -->
    <div class="footer">
        <span>Notifications des dernières 24 heures</span>
        <a href="#">Voir toutes les notifications</a>
    </div>
</div>

<style>
    /* Base styles */
    .notification-item {
        position: relative;
        padding: 0;
    }
    
    .notification-content {
        display: flex;
        padding: 16px;
    }
    
    .notification-icon {
        margin-right: 12px;
        flex-shrink: 0;
    }
    
    .notification-text h3 {
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 4px;
    }
    
    .notification-text p {
        font-size: 14px;
        color: #4B5563;
        margin-bottom: 4px;
    }
    
    .notification-text span {
        font-size: 12px;
        display: block;
    }
    
    .close-btn {
        position: absolute;
        top: 16px;
        right: 16px;
        color: #9CA3AF;
    }
    
    .close-btn:hover {
        color: #6B7280;
    }
    
    .footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 16px;
        background-color: #F9FAFB;
        font-size: 14px;
    }
    
    .footer span {
        color: #6B7280;
    }
    
    .footer a {
        color: #3B82F6;
        text-decoration: none;
    }
    
    .footer a:hover {
        color: #2563EB;
    }
    
    /* Notification type styles */
    .notification-urgent {
        border-left: 4px solid #ef4444;
        background-color: #fee2e2;
    }
    
    .notification-urgent .notification-icon {
        color: #ef4444;
    }
    
    .notification-urgent h3 {
        color: #991b1b;
    }
    
    .notification-urgent span {
        color: #ef4444;
    }
    
    .notification-success {
        border-left: 4px solid #10b981;
        background-color: #ecfdf5;
    }
    
    .notification-success .notification-icon {
        color: #10b981;
    }
    
    .notification-success h3 {
        color: #065f46;
    }
    
    .notification-success span {
        color: #10b981;
    }
    
    .notification-info {
        border-left: 4px solid #3b82f6;
        background-color: #eff6ff;
    }
    
    .notification-info .notification-icon {
        color: #3b82f6;
    }
    
    .notification-info h3 {
        color: #1e40af;
    }
    
    .notification-info span {
        color: #3b82f6;
    }
    
    .notification-warning {
        border-left: 4px solid #f59e0b;
        background-color: #fffbeb;
    }
    
    .notification-warning .notification-icon {
        color: #f59e0b;
    }
    
    .notification-warning h3 {
        color: #92400e;
    }
    
    .notification-warning span {
        color: #f59e0b;
    }
    
    .notification-default {
        border-left: 4px solid #6b7280;
        background-color: #f3f4f6;
    }
    
    .notification-default .notification-icon {
        color: #6b7280;
    }
    
    .notification-default h3 {
        color: #1f2937;
    }
    
    .notification-default span {
        color: #6b7280;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const closeButtons = document.querySelectorAll('.close-btn');
        
        closeButtons.forEach(button => {
            button.addEventListener('click', function() {
                const notification = this.closest('.notification-item');
                notification.style.display = 'none';
                
                // Optional: AJAX call to mark notification as read
                const notificationId = notification.dataset.id;
                if (notificationId) {
                    fetch('/notifications/mark-as-read/' + notificationId, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json',
                        },
                    });
                }
            });
        });
    });
</script>
@endsection