@extends('admin.layout')

@section('admin_content')
<div class="space-y-6">
        <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
            <h1 class="text-2xl font-black text-gray-900">Edit Tag</h1>
            <p class="text-gray-500 text-sm mt-1">Update tag details.</p>
        </div>
        <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
            <form action="{{ route('admin.tags.update', $tag->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 mb-2">Name</label>
                        <input type="text" class="w-full px-4 py-2 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 category-name" name="name" value="{{ $tag->name }}">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 mb-2">Slug</label>
                        <input type="text" class="w-full px-4 py-2 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 category-slug" name="slug" value="{{ $tag->slug }}" readonly>
                        @error('slug')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex justify-end items-center gap-4 pt-4">
                        <a href="{{ route('admin.tags.index') }}" class="text-gray-500 hover:text-gray-700 font-bold">Cancel</a>
                        <button type="submit" class="bg-[#0A4088] text-white px-6 py-2.5 rounded-2xl hover:bg-[#08306b] transition font-bold">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
