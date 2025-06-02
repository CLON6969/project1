@extends('layouts.web')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 text-gray-900">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-black">Homepage Table Records</h1>
        <a href="{{ route('admin.web.homepage.table.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded shadow text-sm font-medium">
            <i class="fas fa-plus mr-2"></i> Add New
        </a>
    </div>

    {{-- Include session alerts --}}
@include('partials.alerts')

    <div class="overflow-x-auto bg-white shadow-2xl rounded-xl border border-slate-300">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs font-semibold tracking-wider">
                <tr>
                    <th class="px-6 py-4 text-left">Picture</th>
                    <th class="px-6 py-4 text-left">URL Name</th>
                    <th class="px-6 py-4 text-left">URL</th>
                    <th class="px-6 py-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-gray-900 bg-white">
                @forelse($records as $item)
                    <tr class="hover:bg-gray-100 transition duration-200">
                        <td class="px-6 py-4">
                            <img src="{{ asset('storage/' . $item->picture) }}" class="w-16 h-10 object-cover rounded border border-gray-300 shadow-sm" />
                        </td>
                        <td class="px-6 py-4 text-sm font-medium">{{ $item->url_name }}</td>
                        <td class="px-6 py-4 text-sm">
                            <a href="{{ $item->url }}" class="text-blue-500 hover:underline" target="_blank">{{ $item->url }}</a>
                        </td>
                        <td class="px-6 py-4 flex gap-2 whitespace-nowrap items-center">
                            <a href="{{ route('admin.web.homepage.table.edit', $item->id) }}"
                               class="inline-flex items-center gap-1 px-4 py-1.5 bg-green-500 hover:bg-green-600 text-black text-xs font-semibold rounded-md shadow transition transform hover:scale-105 hover:ring-2 hover:ring-green-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 11l6 6m2-2a2.828 2.828 0 00-4-4L9 11l-4 4V7h8z" />
                                </svg>
                                Edit
                            </a>
                            <form method="POST" action="{{ route('admin.web.homepage.table.destroy', $item->id) }}" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center gap-1 px-4 py-1.5 bg-red-500 hover:bg-red-600 text-white text-xs font-semibold rounded-md shadow transition transform hover:scale-105 hover:ring-2 hover:ring-red-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-6 text-center text-gray-500 italic">No records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
