<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Page' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{ $header ?? '' }}
</head>

<body class="bg-gray-50 text-gray-700 font-sans leading-normal tracking-normal">

    <div id="app" class="flex h-screen">

        <div id="sidebar"
            class="sidebar bg-white text-gray-700 w-64 space-y-6 py-6 px-4 absolute inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition duration-200 ease-in-out shadow-md border-r border-gray-200 z-50">
            {{-- Ensured sidebar is z-50 --}}
            <div class="flex items-center justify-start px-3 mb-6">
                <a href="{{ route('admin.dashboard') }}" class="text-blue-700 text-xl font-bold flex items-center">
                    <i class="fas fa-code fa-lg mr-2"></i> Xien <span class="text-sm text-gray-500 ml-1">Dev</span>
                </a>
            </div>

            <nav class="space-y-2">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center py-2.5 px-3 rounded-lg transition duration-200 hover:bg-blue-50 hover:text-blue-700 @if (request()->routeIs('admin.category.index') || request()->is('admin/category/*')) bg-blue-50 text-blue-700 font-semibold @endif">
                    <i class="fas fa-home fa-lg mr-3 text-blue-500"></i> Trang chủ
                </a>
                <h3 class="text-xs font-semibold uppercase text-gray-500 mt-4 mb-2 px-3">Quản lý</h3>
                <a href="{{ route('admin.categories.index') }}"
                    class="flex items-center py-2.5 px-3 rounded-lg transition duration-200 hover:bg-blue-50 hover:text-blue-700 @if (request()->routeIs('admin.category.index') || request()->is('admin/category/*')) bg-blue-50 text-blue-700 font-semibold @endif">
                    <i class="fas fa-sitemap fa-lg mr-3 text-blue-500"></i> Quản lý danh mục
                </a>
                <a href="{{ route('admin.users.index') }}"
                    class="flex items-center py-2.5 px-3 rounded-lg transition duration-200 hover:bg-blue-50 hover:text-blue-700 @if (request()->routeIs('admin.user.index') || request()->is('admin/user/*')) bg-blue-50 text-blue-700 font-semibold @endif">
                    <i class="fas fa-user-friends fa-lg mr-3 text-blue-500"></i> Quản lý người dùng
                </a>
                <a href="{{ route('admin.contacts.index') }}"
                    class="flex items-center py-2.5 px-3 rounded-lg transition duration-200 hover:bg-blue-50 hover:text-blue-700 @if (request()->routeIs('admin.contact.index') || request()->is('admin/contact/*')) bg-blue-50 text-blue-700 font-semibold @endif">
                    <i class="fas fa-envelope-open-text fa-lg mr-3 text-blue-500"></i> Quản lý liên hệ
                </a>
                <a href="{{ route('admin.posts.index') }}"
                    class="flex items-center py-2.5 px-3 rounded-lg transition duration-200 hover:bg-blue-50 hover:text-blue-700 @if (request()->routeIs('admin.post.index') || request()->is('admin/post/*')) bg-blue-50 text-blue-700 font-semibold @endif">
                    <i class="fas fa-newspaper fa-lg mr-3 text-blue-500"></i> Quản lý bài viết
                </a>


            </nav>

        </div>

        <div id="sidebar-overlay"
            class="fixed inset-0 bg-black opacity-0 hidden md:hidden z-40 transition-opacity duration-200 ease-in-out">
        </div>

        <div class="flex-1 flex flex-col overflow-hidden z-10"> {{-- Applied z-10 here --}}
            <header
                class="flex justify-between items-center bg-white border-b border-gray-200 p-4 sticky top-0 z-30 shadow-sm">
                <button id="mobile-menu-button"
                    class="md:hidden p-2 text-gray-600 rounded-md hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    <i class="fas fa-bars text-xl"></i>
                </button>

                <div class="relative flex items-center w-full max-w-md">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" placeholder="Search..."
                        class="w-full pl-10 pr-4 py-2 rounded-md border border-gray-300 focus:border-blue-400 focus:ring-blue-400 focus:ring-1 text-sm">
                </div>

                <div class="flex items-center space-x-4 ml-auto">
                    <button class="text-gray-500 hover:text-gray-700 focus:outline-none">
                        <i class="fas fa-bell text-lg"></i>
                    </button>
                    <button class="text-gray-500 hover:text-gray-700 focus:outline-none">
                        <i class="fas fa-cog text-lg"></i>
                    </button>
                    <div class="relative">
                        <button id="user-menu-button"
                            class="flex items-center space-x-2 rounded-full focus:outline-none p-0.5">
                            <i class="fas fa-user-circle text-gray-500 text-lg"></i>
                            <span
                                class="hidden md:block text-gray-700 font-medium text-sm">{{ Auth::user()->name ?? 'N/A' }}</span>
                        </button>
                        <div id="user-menu-dropdown"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-md border border-gray-200 py-1 shadow-lg z-20 hidden">
                            <a href="#"
                                class="block px-4 py-2 text-gray-800 hover:bg-gray-50 transition-colors duration-150">
                                <i class="fas fa-user-circle mr-2"></i> Profile
                            </a>
                            <a href="#"
                                class="block px-4 py-2 text-gray-800 hover:bg-gray-50 transition-colors duration-150">
                                <i class="fas fa-cog mr-2"></i> Settings
                            </a>
                            <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-50 transition-colors duration-150">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Đăng xuất
                                </button>
                            </form>

                            <form id="logout-form" action="" method="POST" style="display: none;"></form>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                {{-- Dynamic Alert Component --}}
                @if (session('success'))
                    <x-alert type="success" title="Thành công!" message="{{ session('success') }}" class="mb-4" />
                @endif
                @if (session('error'))
                    <x-alert type="error" title="Lỗi!" message="{{ session('error') }}" class="mb-4" />
                @endif
                @if (session('warning'))
                    <x-alert type="warning" title="Cảnh báo!" message="{{ session('warning') }}" class="mb-4" />
                @endif
                @if (session('info'))
                    <x-alert type="info" title="Thông tin!" message="{{ session('info') }}" class="mb-4" />
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>
    {{ $footer ?? '' }}
    <script src="{{ asset('backend/js/script.js') }}"></script>
    <script type="text/javascript">
        // Sidebar and Dropdown logic
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebar-overlay');
            const userMenuButton = document.getElementById('user-menu-button');
            const userMenuDropdown = document.getElementById('user-menu-dropdown');

            mobileMenuButton.addEventListener('click', () => {
                sidebar.classList.toggle('-translate-x-full');
                sidebarOverlay.classList.toggle('hidden');
                sidebarOverlay.classList.toggle('opacity-0');
                sidebarOverlay.classList.toggle('opacity-50');
            });

            sidebarOverlay.addEventListener('click', () => {
                sidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('hidden', 'opacity-0');
                sidebarOverlay.classList.remove('opacity-50');
            });

            userMenuButton.addEventListener('click', (e) => {
                e.stopPropagation();
                userMenuDropdown.classList.toggle('hidden');
            });

            document.addEventListener('click', (e) => {
                if (!userMenuButton.contains(e.target) && !userMenuDropdown.contains(e.target)) {
                    userMenuDropdown.classList.add('hidden');
                }
            });
        });
    </script>

</body>

</html>
