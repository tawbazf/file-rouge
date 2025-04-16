@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 px-4">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Certifications</h1>
        <p class="text-gray-600 mt-2">Browse our available certification programs</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($certifications as $certification)
            <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:shadow-lg hover:-translate-y-1">
                <div class="h-48 bg-gray-200 overflow-hidden">
                    @if($certification->image)
                        <img src="{{ asset('storage/' . $certification->image) }}" alt="{{ $certification->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gray-300">
                            <span class="text-gray-500">No Image Available</span>
                        </div>
                    @endif
                </div>
                <div class="p-5">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $certification->name }}</h2>
                    <p class="text-gray-600 mb-4 line-clamp-3">{{ $certification->description }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-blue-600 font-medium">{{ $certification->duration }}</span>
                        <a href="{{ route('certifications.show', $certification->id) }}" 
                           class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-10 text-center">
                <p class="text-gray-500 text-lg">No certifications available at the moment.</p>
            </div>
        @endforelse
    </div>

    @if($certifications->hasPages())
        <div class="mt-8">
            {{ $certifications->links() }}
        </div>
    @endif
</div>
@endsection