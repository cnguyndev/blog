<x-layout-admin>
    <x-slot:title>Thùng rác Bài viết</x-slot:title>

    <div class="card bg-white shadow-sm rounded-lg border border-gray-200 p-6">
        <div class="flex justify-between items-center mb-4 border-b pb-4 border-gray-200">
            <div>
                <h6 class="text-gray-800 text-xl font-bold">Thùng rác Bài viết</h6>
                <nav aria-label="breadcrumb" class="text-sm font-medium text-gray-500">
                    <ol class="flex items-center space-x-1">
                        <li><a href="{{ route('admin.dashboard') }}" class="hover:underline">Trang chủ</a></li>
                        <li><i class="fas fa-chevron-right text-xs"></i></li>
                        <li><a href="{{ route('admin.posts.index') }}" class="hover:underline">Bài viết</a></li>
                        <li><i class="fas fa-chevron-right text-xs"></i></li>
                        <li>Thùng rác</li>
                    </ol>
                </nav>
            </div>
            <div class="flex space-x-3 items-center">
                <div class="relative w-48">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400 text-sm"></i>
                    </div>
                    <input type="text" placeholder="Tìm kiếm bài viết..."
                        class="w-full pl-10 pr-4 py-2 rounded-md border border-gray-300 focus:border-blue-400 focus:ring-blue-400 focus:ring-1 text-sm">
                </div>
                <a href="{{ route('admin.posts.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg">
                    <i class="fa-solid fa-arrow-left mr-2 text-base"></i> Quay lại Bài viết
                </a>
                @if ($trashedPosts->count() > 0)
                    <form action="{{ route('admin.posts.forceDeleteAll') }}" method="POST"
                        onsubmit="return confirm('Bạn có chắc muốn XÓA VĨNH VIỄN TẤT CẢ các bài viết trong thùng rác? Hành động này không thể hoàn tác!');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg">
                            <i class="fas fa-bomb mr-2"></i> Xóa vĩnh viễn tất cả
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border-collapse text-slate-600">
                <thead class="align-bottom">
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b border-gray-200">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Tiêu đề</th>
                        <th class="py-3 px-6 text-left">Ngày xóa</th>
                        <th class="py-3 px-6 text-left">Người xóa</th>
                        <th class="py-3 px-6 text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse ($trashedPosts as $post)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-3 px-6 text-left whitespace-nowrap">{{ $post->id }}</td>
                            <td class="py-3 px-6 text-left">{{ Str::limit($post->title, 50) }}</td>
                            <td class="py-3 px-6 text-left">{{ $post->deleted_at->format('d/m/Y H:i:s') }}</td>
                            <td class="py-3 px-6 text-left">{{ $post->updater->name ?? 'N/A' }}</td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center space-x-2">
                                    <form action="{{ route('admin.posts.restore', $post->id) }}" method="POST"
                                        onsubmit="return confirm('Bạn có chắc muốn khôi phục bài viết này?');"
                                        class="inline-block">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" title="Khôi phục"
                                            class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors duration-150">
                                            <i class="fas fa-undo mr-1"></i> Khôi phục
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.posts.forceDelete', $post->id) }}" method="POST"
                                        onsubmit="return confirm('Bạn có chắc muốn XÓA VĨNH VIỄN bài viết này? Hành động này không thể hoàn tác!');"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Xóa vĩnh viễn"
                                            class="inline-flex items-center text-sm font-medium text-red-600 hover:text-red-800 transition-colors duration-150">
                                            <i class="fas fa-bomb mr-1"></i> Xóa vĩnh viễn
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-3 px-6 text-center">Thùng rác bài viết trống.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $trashedPosts->links() }}
        </div>
    </div>
</x-layout-admin>
