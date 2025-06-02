@extends('layouts.web')

@section('content')
<div class="max-w-3xl mx-auto px-6 py-10 bg-white rounded-xl shadow-lg border border-gray-200 text-gray-900">
    <h2 class="text-2xl font-bold text-green-700 mb-6">Edit Company Statement</h2>

        {{-- Include session alerts --}}
@include('partials.alerts')

    <form action="{{ route('admin.web.homepage.statements.update', $statement->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label class="block mb-1 text-sm font-medium" for="title1">Title</label>
            <input type="text" name="title1" id="title1"
                   value="{{ old('title1', $statement->title1) }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:outline-none"
                   required>
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium" for="title1_main_content">Main Content</label>
            <textarea name="title1_main_content" id="title1_main_content" rows="4"
                      class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:outline-none">{{ old('title1_main_content', $statement->title1_main_content) }}</textarea>
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium" for="title1_sub_content">Sub Content</label>
            <textarea name="title1_sub_content" id="title1_sub_content" rows="3"
                      class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:outline-none">{{ old('title1_sub_content', $statement->title1_sub_content) }}</textarea>
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium" for="background_picture">Background Picture</label>
            <input type="file" name="background_picture" id="background_picture"
                   class="block w-full text-sm text-gray-600 border border-gray-300 rounded-md shadow-sm file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:bg-green-50 file:text-green-700 hover:file:bg-green-100 transition duration-200 ease-in-out">
            
            @if($statement->background_picture)
                <div class="mt-4">
                    <img src="{{ asset('storage/uploads/pics/' . $statement->background_picture) }}" alt="Current Background"
                         class="w-24 h-auto rounded shadow border border-gray-300">
                </div>
            @endif
        </div>

        <div class="pt-6 flex gap-4">
            {{-- Update Button --}}
            <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-lg shadow transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-lg focus:outline-none">
                <i class="fas fa-save mr-2"></i> Update
            </button>



            {{-- Optional Back Button --}}
            <a href="{{ route('admin.web.homepage.statements.index') }}"
               class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium px-6 py-2 rounded-lg shadow transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-md focus:outline-none">
                ← Back
            </a>
        </div>
    </form>
</div>
@endsection
