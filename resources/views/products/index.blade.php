@extends('template')

@section('content')

    <div class="mt-10 px-14">
        <div class="header z-10 relative">
            
            <div class="title-container mt-5">
                <h1 class="font-extrabold text-[64px] text-center">What We Bring?</h1>
                <p class="text-[24px] text-center w-4xl mx-auto mt-5">Making it easier to find and rent the gear and rides you need, whenever you need them.</p>
            </div>
            
            <form action="javascript:void(0);" method="GET" onsubmit="handleSearch(event)">
                <div class="search-container mt-10">
                    <div class="relative w-4xl mx-auto">
                        <input type="search" name="search" id="search" placeholder="Search for products..." value="{{ $search ?? '' }}" class="border border-gray-300 rounded-full px-4 py-2 pl-10 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent w-full shadow-md bg-white">
                        <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
            </form>

            <script>
                function handleSearch(e) {
                    e.preventDefault();
                    const searchInput = document.getElementById('search').value;
                    if (searchInput.trim()) {
                        window.location.href = '/products/search/' + encodeURIComponent(searchInput);
                    } else {
                        window.location.href = '/products';
                    }
                }
            </script>
        </div>

        <div class="illustration absolute right-0 top-10">
            <img src="/images/Group86.png" alt="">
        </div>

        <div class="illustration absolute left-0 bottom-0">
            <img src="/images/Group85.png" alt="">
        </div>

        <div class="list-products z-10 relative my-10">

            @foreach ($groupedProducts as $categoryName => $categoryProducts)
                <div class="category bg-[#0A4088] rounded-lg p-5 w-60 text-center mb-10 flex items-center justify-center gap-3">
                    <h3 class="font-bold text-white">{{ $categoryName }}</h3>

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="size-6">
                        <path fill-rule="evenodd" d="M16.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z" clip-rule="evenodd" />
                    </svg>
                </div>
                
                <div class="card-wrapper grid grid-cols-4 gap-2 mb-10">
                    @foreach ($categoryProducts as $product)
                        <div class="card-container bg-[#EDEAEA] shadow-md rounded-lg p-5 max-w-sm mx-auto">
                            <img src="/images/Rectangle24.png" alt="" class="rounded-lg ">
                            <h2 class="text-[32px] font-bold uppercase">{{ $product->nama_produk }}</h2>
                            <h3 class="text-[15px] text-slate-500 uppercase">{{ $product->deskripsi }}</h3>

                            <div class="price flex items-center justify-between mt-4">

                                <div>
                                    <span class="text-[24px] font-bold text-[#0A4088]">Rp {{ number_format($product->harga, 0, ',', '.') }}</span>

                                    <span class="text-[16px] text-gray-500 line-through ml-2">Rp 200.000</span>
                                </div>

                                <div>
                                    <a href="https://wa.me/6281938092473?text=Halooo Saya tertarik menyewa {{ $product->nama_produk }} dari websitemu. Tolong berikan saya detail barangnya?" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="size-10 bg-green-500 rounded-full p-2 border-white border-2 cursor-pointer hover:bg-green-600 transition-colors">
                                            <path fill-rule="evenodd" d="M1.5 4.5a3 3 0 0 1 3-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 0 1-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 0 0 6.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 0 1 1.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 0 1-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5Z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach

        </div>

    </div>
    
@endsection