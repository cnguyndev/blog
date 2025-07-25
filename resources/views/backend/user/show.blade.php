<x-layout-admin>
    <x-slot:title>Chi tiết Người dùng: {{ $user->name }}</x-slot:title>

    <div class="card bg-white shadow-sm rounded-lg border border-gray-200 p-6">
        <div class="flex justify-between items-center mb-6 border-b pb-4 border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800">Chi tiết Người dùng: {{ $user->name }}</h2>
            <a href="{{ route('admin.users.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-lg">
                <i class="fas fa-arrow-left mr-2"></i> Quay lại danh sách
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-8 mb-8">
            {{-- Thông tin chung --}}
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-3 border-b border-gray-100 pb-2">Thông tin chung</h3>
                <p class="text-gray-700 mb-2">
                    <strong class="text-gray-800">ID:</strong> {{ $user->id }}
                </p>
                <p class="text-gray-700 mb-2">
                    <strong class="text-gray-800">Tên:</strong> {{ $user->name }}
                </p>
                <p class="text-gray-700 mb-2">
                    <strong class="text-gray-800">Email:</strong> {{ $user->email }}
                </p>
                <p class="text-gray-700 mb-2">
                    <strong class="text-gray-800">Trạng thái:</strong>
                    <span
                        class="font-semibold px-3 py-1 rounded-full text-sm {{ $user->status == 1 ? 'text-green-700 bg-green-100' : 'text-red-700 bg-red-100' }}">
                        {{ $user->status == 1 ? 'Hoạt động' : 'Không hoạt động' }}
                    </span>
                </p>
                <p class="text-gray-700 mb-2">
                    <strong class="text-gray-800">Ngày tạo:</strong> {{ $user->created_at->format('d/m/Y H:i:s') }}
                </p>
                <p class="text-gray-700 mb-2">
                    <strong class="text-gray-800">Ngày cập nhật:</strong> {{ $user->updated_at->format('d/m/Y H:i:s') }}
                </p>
            </div>
        </div>

        {{-- Nút hành động --}}
        <div class="flex items-center justify-end mt-6 space-x-3">
            <a href="{{ route('admin.users.edit', $user->id) }}"
                class="inline-flex items-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white text-sm font-medium rounded-lg">
                <i class="fas fa-edit mr-2"></i> Chỉnh sửa
            </a>
        </div>
    </div>
</x-layout-admin>
