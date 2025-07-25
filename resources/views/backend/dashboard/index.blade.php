<x-layout-admin>
    <x-slot:title>Bảng điều khiển Admin</x-slot:title> {{-- Changed title for consistency --}}

    <div class="card bg-white shadow-sm rounded-lg border border-gray-200 p-6">
        <h6 class="text-2xl font-bold mb-4 text-gray-800">Chào mừng đến với Bảng điều khiển Admin!</h6>
        {{-- Adjusted heading style --}}

        <p class="mb-6 text-gray-700">Bạn đang đăng nhập với tư cách: <span
                class="font-semibold text-gray-800">{{ Auth::user()->name ?? 'N/A' }}</span>
            ({{ Auth::user()->email ?? 'N/A' }})</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4"> {{-- Consistent gap --}}
            <a href="{{ route('admin.dashboard') }}"
                class="flex flex-col items-center justify-center p-4 text-center bg-blue-50 rounded-lg shadow-sm hover:shadow-md transition-shadow border border-blue-200">
                {{-- New card style --}}
                <div
                    class="mb-2 inline-flex items-center justify-center w-12 h-12 text-center rounded-full bg-blue-500 text-white">
                    {{-- Simplified background --}}
                    <i class="fas fa-home text-lg"></i>
                </div>
                <span class="font-semibold text-blue-800">Dashboard</span> {{-- Consistent text color --}}
            </a>

            <a href="{{ route('admin.posts.index') }}"
                class="flex flex-col items-center justify-center p-4 text-center bg-green-50 rounded-lg shadow-sm hover:shadow-md transition-shadow border border-green-200">
                {{-- New card style --}}
                <div
                    class="mb-2 inline-flex items-center justify-center w-12 h-12 text-center rounded-full bg-green-500 text-white">
                    {{-- Simplified background --}}
                    <i class="fas fa-newspaper text-lg"></i>
                </div>
                <span class="font-semibold text-green-800">Quản lý Bài viết</span> {{-- Consistent text color --}}
            </a>

            <a href="{{ route('admin.categories.index') }}"
                class="flex flex-col items-center justify-center p-4 text-center bg-yellow-50 rounded-lg shadow-sm hover:shadow-md transition-shadow border border-yellow-200">
                {{-- New card style --}}
                <div
                    class="mb-2 inline-flex items-center justify-center w-12 h-12 text-center rounded-full bg-yellow-500 text-white">
                    {{-- Simplified background --}}
                    <i class="fas fa-sitemap text-lg"></i>
                </div>
                <span class="font-semibold text-yellow-800">Quản lý Danh mục</span> {{-- Consistent text color --}}
            </a>

            <a href="{{ route('admin.users.index') }}"
                class="flex flex-col items-center justify-center p-4 text-center bg-indigo-50 rounded-lg shadow-sm hover:shadow-md transition-shadow border border-indigo-200">
                {{-- New card style --}}
                <div
                    class="mb-2 inline-flex items-center justify-center w-12 h-12 text-center rounded-full bg-indigo-500 text-white">
                    {{-- Simplified background --}}
                    <i class="fas fa-user-friends text-lg"></i>
                </div>
                <span class="font-semibold text-indigo-800">Quản lý Người dùng</span> {{-- Consistent text color --}}
            </a>

            <a href="{{ route('admin.contacts.index') }}"
                class="flex flex-col items-center justify-center p-4 text-center bg-purple-50 rounded-lg shadow-sm hover:shadow-md transition-shadow border border-purple-200">
                {{-- New card style --}}
                <div
                    class="mb-2 inline-flex items-center justify-center w-12 h-12 text-center rounded-full bg-purple-500 text-white">
                    {{-- Simplified background --}}
                    <i class="fas fa-envelope text-lg"></i>
                </div>
                <span class="font-semibold text-purple-800">Quản lý Liên hệ</span> {{-- Consistent text color --}}
            </a>

        </div>
    </div>
</x-layout-admin>
