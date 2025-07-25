<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'NIOO.IO.VN - Get Software Free' }} - NIOO.IO.VN - Get Software Free</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{ $header ?? '' }}
</head>

<body class="font-roboto">
    <nav
        class="relative flex w-full flex-wrap items-center justify-between py-2 lg:py-4 px-4 lg:px-8 bg-transparent shadow-none border-0 sticky top-0 z-50 transition-all duration-300 ease-in-out">
        <div class="container mx-auto flex items-center justify-between">
            <a class="text-blue-gray-900 text-lg font-bold" onclick="window.location.href='{{ route('site.home') }}'">
                NIOO.IO.VN
            </a>
            <ul class="ml-10 hidden items-center gap-8 lg:flex">
                <li>
                    <a class="flex items-center gap-2 font-medium text-gray-900 hover:text-red-500"
                        onclick="window.location.href='{{ route('site.home') }}'">
                        <i class="fa-solid fa-house"></i>
                        Trang chủ
                    </a>
                </li>
                @foreach ($categories as $parent)
                    @if ($parent->parent_id == 0)
                        @php
                            $drop = $parent->children->count() > 0;
                        @endphp

                        <li class="relative group">
                            <a href="{{ route('site.category', $parent->slug) }}"
                                class="flex items-center gap-2 font-medium text-gray-900 cursor-pointer hover:text-red-500 transition-colors">
                                {{ $parent->name }}
                                @if ($drop)
                                    <i
                                        class="fas fa-angle-down ml-1 text-sm transition-transform duration-300 group-hover:rotate-180"></i>
                                @endif
                            </a>

                            @if ($drop)
                                <ul id="dropdown-{{ $parent->id }}"
                                    class="absolute z-10 bg-white shadow-lg rounded-md py-2 w-48
                           opacity-0 pointer-events-none transform scale-y-0 origin-top
                           transition-all duration-300 ease-in-out
                           group-hover:opacity-100 group-hover:scale-y-100 group-hover:pointer-events-auto">
                                    @foreach ($parent->children as $child)
                                        <li>
                                            <a href="{{ route('site.category', $child->slug) }}"
                                                class="block px-4 py-2 text-gray-800 hover:bg-gray-100 transition-colors">
                                                {{ $child->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endif
                @endforeach

                <li class="relative group">
                    <a href="#" id="services-dropdown-toggle"
                        class="flex items-center gap-2 font-medium text-gray-900 cursor-pointer hover:text-red-500 transition-colors">
                        Khác<i
                            class="fas fa-angle-down ml-1 text-sm transition-transform duration-300 group-hover:rotate-180"></i>
                    </a>
                    <ul id="services-dropdown-menu"
                        class="absolute z-10 bg-white shadow-lg rounded-md py-2 w-48
                           opacity-0 pointer-events-none transform scale-y-0 origin-top
                           transition-all duration-300 ease-in-out
                           group-hover:opacity-100 group-hover:scale-y-100 group-hover:pointer-events-auto">
                        <li>
                            <a class="block px-4 py-2 text-gray-800 hover:bg-gray-100 transition-colors"
                                href="https://url.nioo.io.vn">
                                <i class="fa-solid fa-link mr-2"></i>
                                Rút gọn liên kết
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('site.api') }}"
                                class="block px-4 py-2 text-gray-800 hover:bg-gray-100 transition-colors">
                                <i class="fa-solid fa-code mr-2"></i>
                                Tài liệu
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="hidden items-center gap-2 lg:flex">
                {{-- <button class="px-4 py-2 rounded-lg text-gray-900 hover:bg-gray-100 transition-colors">Liên hệ</button>
                <a href="{{ route('site.contact') }}" target="_blank">
                    <button
                        class="px-4 py-2 rounded-lg bg-gray-900 text-white hover:bg-gray-800 transition-colors">blocks</button>
                </a> --}}
            </div>
            <button
                class="ml-auto inline-block lg:hidden p-2 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors"
                onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>
        <div id="mobile-menu" class="hidden container mx-auto mt-3 border-t border-gray-200 px-4 pt-4 lg:hidden">
            <ul class="flex flex-col gap-4">
                <li>
                    <a href="{{ route('site.home') }}"
                        class="flex items-center gap-2 font-medium text-gray-900 hover:text-red-500">
                        <i class="fa-solid fa-house"></i>
                        Trang chủ
                    </a>
                </li>
                @foreach ($categories as $parent)
                    @if ($parent->parent_id == 0 && $parent->status == 1)
                        @php
                            $children = $parent->children->where('status', 1);
                            $hasChildren = $children->isNotEmpty();
                        @endphp

                        <li class="relative">
                            <a class="flex items-center gap-2 font-medium text-gray-900 cursor-pointer hover:text-red-500 transition-colors mobile-dropdown-toggle"
                                {!! $hasChildren
                                    ? 'data-target=mobile-dropdown-' . $parent->id
                                    : 'onclick=window.location.href=\'' . url('danh-muc/' . $parent->slug) . '\'' !!}>
                                {{ $parent->name }}
                                @if ($hasChildren)
                                    <i class="fas fa-angle-down ml-1 text-sm transition-transform duration-300"></i>
                                @endif
                            </a>

                            @if ($hasChildren)
                                <ul id="mobile-dropdown-{{ $parent->id }}"
                                    class="hidden bg-gray-50 rounded-md mt-2 py-2 ml-4 mobile-dropdown-menu">
                                    @foreach ($children as $child)
                                        <li>
                                            <a onclick="window.location.href='{{ url('danh-muc/' . $child->slug) }}'"
                                                class="block px-4 py-2 text-gray-800 hover:bg-gray-200 transition-colors">
                                                {{ $child->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endif
                @endforeach
                <li class="relative">
                    <a href="#" id="mobile-services-dropdown-toggle"
                        class="flex items-center gap-2 font-medium text-gray-900 cursor-pointer hover:text-red-500 transition-colors mobile-dropdown-toggle"
                        data-target="mobile-services-dropdown-menu">
                        Khác <i class="fas fa-angle-down ml-1 text-sm transition-transform duration-300"></i>
                    </a>
                    <ul id="mobile-services-dropdown-menu"
                        class="hidden bg-gray-50 rounded-md mt-2 py-2 ml-4 mobile-dropdown-menu">
                        <li>
                            <a class="block px-4 py-2 text-gray-800 hover:bg-gray-200 transition-colors"
                                onclick="window.location.href='https://url.nioo.io.vn'">
                                <i class="fa-solid fa-link mr-2"></i>
                                Rút gọn liên kết
                            </a>
                        </li>
                        <li>
                            <a class="block px-4 py-2 text-gray-800 hover:bg-gray-200 transition-colors"
                                onclick="window.location.href='{{ route('site.api') }}'">
                                <i class="fa-solid fa-code mr-2"></i>
                                Tài liệu
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
            <div class="mt-6 mb-4 flex flex-col items-center gap-2 sm:flex-row sm:justify-start">
                {{-- <button
                    class="px-4 py-2 rounded-lg text-gray-900 hover:bg-gray-100 transition-colors w-full sm:w-auto">Sign
                    In</button>
                <a href="https://www.material-tailwind.com/blocks" target="_blank" class="w-full sm:w-auto">
                    <button
                        class="px-4 py-2 rounded-lg bg-gray-900 text-white hover:bg-gray-800 transition-colors w-full">blocks</button>
                </a> --}}
            </div>
        </div>
    </nav>
    <div class="container mx-auto px-4 mt-4">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Thành công!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer"
                    onclick="this.parentElement.style.display='none';">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title>Đóng</title>
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 2.63a1.2 1.2 0 1 1-1.697-1.697l2.758-2.758-2.758-2.758a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-2.651a1.2 1.2 0 1 1 1.697 1.697l-2.758 2.758 2.758 2.758a1.2 1.2 0 0 1 0 1.697z" />
                    </svg>
                </span>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Lỗi!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer"
                    onclick="this.parentElement.style.display='none';">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title>Đóng</title>
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 2.63a1.2 1.2 0 1 1-1.697-1.697l2.758-2.758-2.758-2.758a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-2.651a1.2 1.2 0 1 1 1.697 1.697l-2.758 2.758 2.758 2.758a1.2 1.2 0 0 1 0 1.697z" />
                    </svg>
                </span>
            </div>
        @endif
    </div>
    <main>
        {{ $slot }}
    </main>

    <footer class="pb-5 p-4 md:p-10">
        <div class="container flex flex-col mx-auto">
            <div
                class="flex !w-full py-10 mb-5 md:mb-20 flex-col justify-center !items-center bg-gray-900 container max-w-6xl mx-auto rounded-2xl p-5 ">
                <h2 class="text-2xl md:text-3xl text-center font-bold text-white">
                    Nhận thông tin về bài viết mơi!
                </h2>
                <p class="text-white md:w-7/12 text-center my-3 !text-base px-4 sm:px-0">
                    Nhận tin tức trong hộp thư đến của bạn mỗi tuần! Chúng tôi cũng ghét thư rác, vì vậy đừng lo lắng
                    về điều này.
                </p>
                <div class="mt-8 flex flex-col items-center justify-center gap-4 md:flex-row w-full px-4 sm:px-0">
                    <div class="w-full sm:w-80">
                        <div class="relative h-10 w-full min-w-[200px]">
                            <input
                                class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-white outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-white placeholder-shown:border-t-white focus:border-2 focus:border-white focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                                placeholder=" " />
                            <label
                                class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-white transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-white before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-white after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-white peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-white peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-white peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-white peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-white">
                                Email
                            </label>
                        </div>
                    </div>
                    <button
                        class="px-4 py-2 rounded-lg bg-white text-gray-900 text-sm font-medium lg:w-32 w-full sm:w-auto hover:bg-gray-100 transition-colors"
                        id="subscribe-button"">

                        Đăng ký
                    </button>
                </div>
            </div>
            <div class="flex flex-col md:flex-row items-center !justify-between text-center md:text-left">
                <a href="{{ route('site.home') }}" target="_blank"
                    class="text-gray-900 text-lg font-semibold mb-4 md:mb-0">
                    NIOO.IO.VN
                </a>
                <ul class="flex flex-wrap justify-center my-4 md:my-0 w-full md:w-max mx-auto items-center gap-4">
                    <li>
                        <a href="{{ route('site.about') }}"
                            class="font-normal !text-gray-700 hover:!text-red-500 transition-colors text-sm">
                            Về chúng tôi
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('site.privacy') }}"
                            class="font-normal !text-gray-700 hover:!text-red-500 transition-colors text-sm">
                            Chính sách và Bảo mật
                        </a>
                    </li>
                </ul>
                <div class="flex w-fit justify-center gap-2 mx-auto md:mx-0">
                    <a href="https://www.facebook.com/ltcnguyen" target="_blank"
                        class="w-8 h-8 rounded-full flex items-center justify-center text-gray-700 hover:bg-gray-100 transition-colors">
                        <i class="fa-brands fa-facebook hover:text-red-500"></i>
                    </a>
                    <a
                        class="w-8 h-8 rounded-full flex items-center justify-center text-gray-700 hover:bg-gray-100 transition-colors">
                        <i class="fa-brands fa-youtube text-lg hover:text-red-500"></i>
                    </a>
                    <a
                        class="w-8 h-8 rounded-full flex items-center justify-center text-gray-700 hover:bg-gray-100 transition-colors">
                        <i class="fa-brands fa-instagram text-lg hover:text-red-500"></i>
                    </a>
                    <a href="https://github.com/cnguyndev" target="_blank"
                        class="w-8 h-8 rounded-full flex items-center justify-center text-gray-700 hover:bg-gray-100 transition-colors">
                        <i class="fa-brands fa-github text-lg hover:text-red-500"></i>
                    </a>
                </div>
            </div>
            <p class="text-center mt-12 font-normal !text-gray-700 text-base">
                &copy; {{ date('Y') }} Create by <a href="{{ route('site.about') }}" class="hover:text-red-500"
                    target="_blank">Lê Trần Chính Nguyên</a>.
            </p>
        </div>
    </footer>

    <a href="#" target="_blank" class="fixed-plugin-link">
        <button
            class="!fixed bottom-4 right-4 flex gap-1 pl-2 items-center border border-blue-gray-50 bg-white text-gray-900 text-sm font-medium py-2 px-3 rounded-lg shadow-md hover:shadow-lg transition-all">
            <i class="fa-solid fa-code"></i>
            NIOO.IO.VN - Get Software Free
        </button>
    </a>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function setupDropdown(toggleElement, isMobile = false) {
                const menuId = toggleElement.dataset.target;
                const menu = document.getElementById(menuId);
                const icon = toggleElement.querySelector('i.fa-angle-down');

                if (menu) {
                    toggleElement.addEventListener('click', function(event) {
                        event.preventDefault();
                        event.stopPropagation();

                        const isOpen = !menu.classList.contains('hidden');

                        document.querySelectorAll('.dropdown-menu, .mobile-dropdown-menu').forEach(
                            otherMenu => {
                                if (otherMenu !== menu) {
                                    otherMenu.classList.add('hidden');
                                    if (!isMobile) {
                                        otherMenu.classList.add('scale-y-0');
                                        otherMenu.classList.remove('scale-y-100');
                                    }
                                    const otherIcon = otherMenu.previousElementSibling?.querySelector(
                                        'i.fa-angle-down');
                                    if (otherIcon) otherIcon.classList.remove('rotate-180');
                                }
                            });

                        menu.classList.toggle('hidden');
                        if (!isMobile) {
                            menu.classList.toggle('scale-y-0');
                            menu.classList.toggle('scale-y-100');
                        }

                        if (icon) {
                            icon.classList.toggle('rotate-180', !isOpen);
                        }
                    });
                }
            }

            document.querySelectorAll('.group .dropdown-toggle').forEach(
                toggle => {
                    setupDropdown(toggle);
                });

            document.querySelectorAll('.mobile-dropdown-toggle').forEach(toggle => {
                setupDropdown(toggle, true);
            });


            document.addEventListener('click', function(event) {
                document.querySelectorAll('.dropdown-menu, .mobile-dropdown-menu').forEach(menu => {
                    const toggle = menu.previousElementSibling;
                    const isMobileMenu = menu.classList.contains('mobile-dropdown-menu');

                    if (toggle && !toggle.contains(event.target) && !menu.contains(event.target)) {
                        menu.classList.add('hidden');
                        if (!isMobileMenu) {
                            menu.classList.add('scale-y-0');
                            menu.classList.remove('scale-y-100');
                        }
                        const icon = toggle.querySelector('i.fa-angle-down');
                        if (icon) icon.classList.remove('rotate-180');
                    }
                });
            });


            const navbar = document.querySelector('nav');
            const scrollThreshold = 50;

            function handleScroll() {
                if (window.scrollY > scrollThreshold) {
                    navbar.classList.add('bg-white', 'shadow-md');
                    navbar.classList.remove('bg-transparent', 'shadow-none');
                } else {
                    navbar.classList.remove('bg-white', 'shadow-md');
                    navbar.classList.add('bg-transparent', 'shadow-none');
                }
            }
            window.addEventListener('scroll', handleScroll);
            handleScroll();
        });
    </script>

    {{ $footer ?? '' }}
</body>

</html>
