@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 px-4">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Certifications</h1>
        <p class="text-gray-600 mt-2">Browse our available certification programs</p>
    </div>

    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($communities as $community)
        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-xl font-semibold text-gray-800">{{ $community->title }}</h2>
            <p class="text-gray-600 mt-2">{{ $community->description }}</p>
            <a href="{{ $community->link }}" class="text-blue-500 hover:underline mt-4 inline-block">
                {{ $community->link_text ?? 'Read More' }}
            </a>
        </div>
    @endforeach
</section>
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