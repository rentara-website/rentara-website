@extends('admin.layout')


@section('admin_content')

<div class="space-y-6">
    <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
        <h1 class="text-2xl font-black text-gray-900">Edit Rating</h1>
        <p class="text-gray-500 text-sm mt-1">Update rating details.</p>
    </div>
    <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
        <form action="{{ route('admin.ratings.update', $rating->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid gap-4">
                <div class="mb-6">
                    <label class="block text-xs font-bold text-gray-400 mb-2">Name</label>
                    <input type="text" class="w-full px-4 py-2 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 category-name" name="nama" value="{{ $rating->nama }}">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label class="block text-xs font-bold text-gray-400 mb-2">Email</label>
                    <input type="email" class="w-full px-4 py-2 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 category-name" name="email" value="{{ $rating->email }}">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label class="block font-semibold mb-2">Rating</label>

                    <div class="flex flex-row-reverse justify-end gap-1">
                        @for ($i = 5; $i >= 1; $i--)
                            <input
                                type="radio"
                                id="rating-{{ $i }}"
                                name="rating"
                                value="{{ $i }}"
                                class="peer hidden"
                                {{ old('rating', $rating->rating) == $i ? 'checked' : '' }}
                                required
                            >
                            <label
                                for="rating-{{ $i }}"
                                class="cursor-pointer text-3xl text-gray-300 transition-colors peer-checked:text-yellow-400 hover:text-yellow-400"
                            >
                                <i data-lucide="star" class="w-8 h-8 fill-current"></i>
                            </label>
                        @endfor
                    </div>

                    @error('rating')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label class="block font-semibold mb-2">Product</label>
                    <select name="product_id"
                        class="w-full px-4 py-2 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 text-black bg-white"
                        required>
                        <option value="" disabled selected hidden class="text-gray-400">
                            Pilih Produk
                        </option>

                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" {{ old('product_id', $rating->product_id) == $product->id ? 'selected' : '' }}>
                                {{$product->id}} - {{ $product->nama_produk }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-400 mb-2">Komentar</label>
                    <textarea name="komentar" rows="4" class="w-full px-4 py-2 border border-gray-100 rounded-2xl focus:outline-none focus:ring-2 focus:ring-[#0A4088]/20 category-name">{{ $rating->komentar }}</textarea>
                    @error('komentar')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex justify-end items-center gap-4 pt-4">
                    <a href="{{ route('admin.ratings.index') }}" class="text-gray-500 hover:text-gray-700 font-bold">Cancel</a>
                    <button type="submit" class="bg-[#0A4088] text-white px-6 py-2.5 rounded-2xl hover:bg-[#08306b] transition font-bold">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection