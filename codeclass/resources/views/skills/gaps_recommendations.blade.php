@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-2xl font-bold mb-4">Recommandations Udemy pour vos lacunes</h2>
    <div class="bg-white rounded shadow p-4">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th>Compétence</th>
                    <th>Niveau actuel</th>
                    <th>Cours Udemy recommandé</th>
                </tr>
            </thead>
            <tbody>
                @forelse($gaps as $item)
                    <tr>
                        <td class="px-6 py-4">{{ $item['skill']->name }}</td>
                        <td class="px-6 py-4">{{ $item['level'] }}/100</td>
                        <td class="px-6 py-4">
                            @if(isset($item['course']) && isset($item['course']['url']))
                                <a href="{{ $item['course']['url'] }}" target="_blank" class="text-indigo-600 hover:underline font-semibold">
                                    {{ $item['course']['title'] ?? 'Voir les cours Udemy' }}
                                </a>
                            @else
                                <a href="https://www.udemy.com/courses/search/?q={{ urlencode($item['skill']->name) }}" target="_blank" class="text-indigo-600 hover:underline font-semibold">
                                    Voir les cours Udemy pour "{{ $item['skill']->name }}"
                                </a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-gray-500 py-4">Aucune lacune détectée.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection