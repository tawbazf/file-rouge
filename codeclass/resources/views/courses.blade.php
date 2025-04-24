@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Our Courses</h1>
        <div class="col-span-full py-12 flex flex-col items-center justify-center bg-gray-50 rounded-lg">
            @if($courses->isEmpty())
                <p class="text-gray-500 text-lg">No courses available yet.</p>
            @else
                <ul class="w-full">
                @foreach($courses as $course)
    <li class="mb-4 p-4 bg-white rounded shadow w-full">
        <h2 class="text-xl font-semibold">{{ $course->title }}</h2>
        <p class="text-gray-600">{{ $course->description }}</p>
    </li>
@endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection