@extends('layouts.web')

@section('content')
<div class="max-w-5xl mx-auto bg-[#0f172a] text-black p-8 rounded-2xl shadow-2xl mt-12 transition-all duration-300">
    <h2 class="text-3xl font-extrabold text-black mb-8">Edit Homepage Content</h2>

    {{-- Include session alerts --}}
@include('partials.alerts')

    <form action="{{ route('admin.web.homepage.content.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
      

        {{-- Main Title --}}
        <div>
            <label for="title1" class="block text-sm font-semibold text-blue-900">Main Title</label>
            <input type="text" name="title1" id="title1" value="{{ old('title1', $content->title1) }}"
                class="mt-2 w-full px-4 py-2 bg-[#1e293b] text-[#334155]  border border-[#334155] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
        </div>

        {{-- Main Title Description --}}
        <div>
            <label for="title1_content" class="block text-sm font-semibold text-blue-300">Main Title Description</label>
            <textarea name="title1_content" id="title1_content" rows="4"
                class="mt-2 w-full px-4 py-2 bg-[#1e293b] text-[#000000] border border-[#334155] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">{{ old('title1_content', $content->title1_content) }}</textarea>
        </div>

        {{-- About Title --}}
        <div>
            <label for="title2" class="block text-sm font-semibold text-blue-300">About Title</label>
            <input type="text" name="title2" id="title2" value="{{ old('title2', $content->title2) }}"
                class="mt-2 w-full px-4 py-2 bg-[#1e293b] text-[#000000] border border-[#334155] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
        </div>

        {{-- About Description --}}
        <div>
            <label for="title2_content" class="block text-sm font-semibold text-blue-300">About Description</label>
            <textarea name="title2_content" id="title2_content" rows="4"
                class="mt-2 w-full px-4 py-2 bg-[#1e293b] text-[#000000] border border-[#334155] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">{{ old('title2_content', $content->title2_content) }}</textarea>
        </div>

        {{-- Background Image Upload --}}
        <div>
            <label for="background_picture" class="block text-sm font-semibold text-blue-300">Background Image</label>
            <input type="file" name="background_picture" id="background_picture"
                class="mt-2 w-full bg-[#1e293b] text-[#000000] border border-[#334155] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
            @if($content->background_picture)
                <img src="{{ asset('storage/uploads/pics/' . $content->background_picture) }}" alt="Current Image" class="mt-3 h-40 object-cover rounded-lg border border-[#334155]">
            @endif
        </div>

        {{-- About Section Image Upload --}}
        <div>
            <label for="picture1" class="block text-sm font-semibold text-blue-300">About Section Image</label>
            <input type="file" name="picture1" id="picture1"
                class="mt-2 w-full bg-[#1e293b] text-[#000000] border border-[#334155] rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
            @if($content->picture1)
                <img src="{{ asset('storage/uploads/pics/' . $content->picture1) }}" alt="Current Image" class="mt-3 h-40 object-cover rounded-lg border border-[#334155]">
            @endif
        </div>

        {{-- Submit Button --}}
        <div class="pt-4">
            <button type="submit"
                class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm rounded-lg shadow-lg transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                Update Content
            </button>
        </div>
    </form>
</div>
@endsection
