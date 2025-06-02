@extends('layouts.web')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-6 bg-white rounded-xl shadow-lg border border-gray-200 text-gray-900">
    <h2 class="text-2xl font-bold mb-6 text-blue-800">Create Company Statement</h2>

{{-- Include session alerts --}}
@include('partials.alerts')

    <form action="{{ route('admin.web.homepage.statements.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-1" for="title1">Title</label>
            <input type="text" name="title1" id="title1" required
                   class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:outline-none">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1" for="title1_main_content">Main Content</label>
            <textarea name="title1_main_content" id="title1_main_content" rows="4"
                      class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:outline-none"></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1" for="title1_sub_content">Sub Content</label>
            <textarea name="title1_sub_content" id="title1_sub_content" rows="3"
                      class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:outline-none"></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1" for="background_picture">Background Picture</label>
            <input type="file" name="background_picture" id="background_picture"
                   class="block w-full text-sm text-gray-600 border border-gray-300 rounded-md shadow-sm file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
        </div>

        <div class="pt-4">
            <button type="submit"
                    class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-lg shadow transition-all">
                Create
            </button>
        </div>
    </form>
</div>
@endsection
