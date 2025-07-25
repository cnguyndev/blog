<x-layout-admin>
    <x-slot:title>Chi tiết Danh mục: {{ $category->name }}</x-slot:title>

    <div class="card bg-white shadow-sm rounded-lg border border-gray-200 p-6">
        <div class="flex justify-between items-center mb-6 border-b pb-4 border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800">Chi tiết Danh mục: {{ $category->name }}</h2>
            <a href="{{ route('admin.categories.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-lg">
                <i class="fas fa-arrow-left mr-2"></i> Quay lại danh sách
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-8 mb-8">
            {{-- Thông tin Danh mục --}}
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-3 border-b border-gray-100 pb-2">Thông tin Danh mục
                </h3>
                <p class="text-gray-700 mb-2">
                    <strong class="text-gray-800">ID:</strong> {{ $category->id }}
                </p>
                <p class="text-gray-700 mb-2">
                    <strong class="text-gray-800">Tên Danh mục:</strong> {{ $category->name }}
                </p>
                <p class="text-gray-700 mb-2">
                    <strong class="text-gray-800">Slug:</strong> {{ $category->slug }}
                </p>
                <p class="text-gray-700 mb-2">
                    <strong class="text-gray-800">Danh mục cha:</strong> {{ $category->parent->name ?? 'Không' }}
                </p>
                <p class="text-gray-700 mb-2">
                    <strong class="text-gray-800">Trạng thái:</strong>
                    <span
                        class="font-semibold px-3 py-1 rounded-full text-sm {{ $category->status == 1 ? 'text-green-700 bg-green-100' : 'text-red-700 bg-red-100' }}">
                        {{ $category->status == 1 ? 'Hoạt động' : 'Không hoạt động' }}
                    </span>
                </p>
                <p class="text-gray-700 mb-2">
                    <strong class="text-gray-800">Ngày tạo:</strong> {{ $category->created_at->format('d/m/Y H:i:s') }}
                </p>
                <p class="text-gray-700 mb-2">
                    <strong class="text-gray-800">Ngày cập nhật:</strong>
                    {{ $category->updated_at->format('d/m/Y H:i:s') }}
                </p>
                <p class="text-gray-700 mb-2">
                    <strong class="text-gray-800">Người tạo:</strong> {{ $category->creator->name ?? 'N/A' }}
                </p>
                <p class="text-gray-700 mb-2">
                    <strong class="text-gray-800">Người cập nhật gần nhất:</strong>
                    {{ $category->updater->name ?? 'N/A' }}
                </p>
            </div>

            {{-- Hình ảnh Danh mục --}}
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-3 border-b border-gray-100 pb-2">Hình ảnh Danh mục
                </h3>
                @if ($category->image)
                    <img src="{{ asset('frontend/images/categories/' . $category->image) }}"
                        alt="{{ $category->name }}"
                        class="mt-2 h-48 w-auto object-contain rounded-lg border border-gray-200 p-2 shadow-sm" />
                @else
                    <div
                        class="h-48 w-full bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 text-lg border border-gray-200">
                        Không có ảnh
                    </div>
                @endif
            </div>
        </div>

        {{-- Nút hành động --}}
        <div class="text-right mt-6 flex justify-end space-x-3">
            <a href="{{ route('admin.categories.edit', $category->id) }}"
                class="inline-flex items-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white text-sm font-medium rounded-lg">
                <i class="fas fa-edit mr-2"></i> Chỉnh sửa
            </a>
        </div>
    </div>
</x-layout-admin>
