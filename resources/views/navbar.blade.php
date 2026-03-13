<div class="navbar-container flex items-center justify-between px-14 py-3 shadow-lg bg-white relative z-10">
    <div class="navbar-logo">
        <img src="/images/Rentara-removebg-preview1.png" alt="" class="w-20">
    </div>

    <div class="navbar-list flex items-center gap-10 font-bold text-lg">
        <div class="navbar-itemsf {{$title}}">
            <a href="">About Us</a>
        </div>
        <div class="navbar-items {{$title === 'Products' ? 'text-white bg-[#0A4088] rounded-full px-7 py-2' : ''}}">
            <a href="/products">Products</a>
        </div>
        <div class="navbar-items">
            <a href="">Help</a>
        </div>
        <div class="navbar-items {{ $title === 'Contact Us' ? 'text-white bg-[#0A4088] rounded-full px-7 py-2' : '' }}">
            <a href="">Contact Us</a>
        </div>
    </div>
</div>