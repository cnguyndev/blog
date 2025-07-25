<x-layout-admin>
    <x-slot:title>Chi tiết Bài viết: {{ $post->title }}</x-slot:title>

    <div class="card bg-white shadow-sm rounded-lg border border-gray-200 p-6">
        <div class="flex justify-between items-center mb-6 border-b pb-4 border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800">Chi tiết Bài viết: {{ $post->title }}</h2>
            <a href="{{ route('admin.posts.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-lg">
                <i class="fas fa-arrow-left mr-2"></i> Quay lại danh sách
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-8 mb-8">
            {{-- Thông tin Bài viết --}}
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-3 border-b border-gray-100 pb-2">Thông tin Bài viết
                </h3>
                <p class="text-gray-700 mb-2">
                    <strong class="text-gray-800">ID:</strong> {{ $post->id }}
                </p>
                <p class="text-gray-700 mb-2">
                    <strong class="text-gray-800">Tiêu đề:</strong> {{ $post->title }}
                </p>
                <p class="text-gray-700 mb-2">
                    <strong class="text-gray-800">Slug:</strong> {{ $post->slug }}
                </p>
                <p class="text-gray-700 mb-2">
                    <strong class="text-gray-800">Danh mục:</strong> {{ $post->category->name ?? 'N/A' }}
                </p>
                <p class="text-gray-700 mb-2">
                    <strong class="text-gray-800">Link Download:</strong> {{ $post->download ?? 'N/A' }}
                </p>
                <p class="text-gray-700 mb-2">
                    <strong class="text-gray-800">Mật khẩu:</strong> {{ $post->password ?? 'N/A' }}
                </p>
                <p class="text-gray-700 mb-2">
                    <strong class="text-gray-800">Lượt xem:</strong> {{ number_format($post->view) }}
                </p>
                <p class="text-gray-700 mb-2">
                    <strong class="text-gray-800">Trạng thái:</strong>
                    <span
                        class="font-semibold px-3 py-1 rounded-full text-sm {{ $post->status == 1 ? 'text-green-700 bg-green-100' : 'text-red-700 bg-red-100' }}">
                        {{ $post->status == 1 ? 'Hoạt động' : 'Không hoạt động' }}
                    </span>
                </p>
                <p class="text-gray-700 mb-2">
                    <strong class="text-gray-800">Ngày tạo:</strong> {{ $post->created_at->format('d/m/Y H:i:s') }}
                </p>
                <p class="text-gray-700 mb-2">
                    <strong class="text-gray-800">Ngày cập nhật:</strong>
                    {{ $post->updated_at->format('d/m/Y H:i:s') }}
                </p>
                <p class="text-gray-700 mb-2">
                    <strong class="text-gray-800">Người tạo:</strong> {{ $post->creator->name ?? 'N/A' }}
                </p>
                <p class="text-gray-700 mb-2">
                    <strong class="text-gray-800">Người cập nhật gần nhất:</strong> {{ $post->updater->name ?? 'N/A' }}
                </p>
            </div>

            {{-- Thumbnail --}}
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-3 border-b border-gray-100 pb-2">Thumbnail</h3>
                @if ($post->thumbnail)
                    <img src="{{ asset('frontend/images/posts/' . $post->thumbnail) }}" alt="Thumbnail"
                        class="w-full h-auto object-cover rounded-md border border-gray-200 p-1 shadow-sm">
                @else
                    <div
                        class="w-full h-48 bg-gray-100 rounded-md flex items-center justify-center text-gray-400 text-lg border border-gray-200">
                        Không có ảnh thumbnail.
                    </div>
                @endif
            </div>
        </div>

        {{-- Nội dung bài viết --}}
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-3 border-b pb-2 border-gray-100">Nội dung</h3>
            <div
                class="prose max-w-none p-4 bg-gray-50 rounded-md text-gray-700 border border-gray-200 min-h-[150px] overflow-auto">
                {!! $post->content !!}
            </div>
        </div>

        {{-- Nút hành động --}}
        <div class="flex items-center justify-end mt-6 space-x-3">
            <a href="{{ route('admin.posts.edit', $post->id) }}"
                class="inline-flex items-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white text-sm font-medium rounded-lg">
                <i class="fas fa-edit mr-2"></i> Chỉnh sửa
            </a>
        </div>
    </div>
</x-layout-admin>
