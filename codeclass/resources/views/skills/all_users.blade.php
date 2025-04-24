@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-2xl font-bold mb-4">Compétences des étudiants</h2>
    <div class="bg-white rounded shadow p-4">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Étudiant</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Compétence</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Niveau</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    @foreach($user->skills as $skill)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $skill->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="w-full bg-gray-200 rounded-full h-4">
                                    <div class="bg-green-500 h-4 rounded-full" style="width: {{ $skill->pivot->level }}%;"></div>
                                </div>
                                <span class="text-xs text-gray-600">{{ $skill->pivot->level }}/100</span>
                            </td>
                        </tr>
                    @endforeach
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-gray-500 py-4">Aucune compétence enregistrée.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection