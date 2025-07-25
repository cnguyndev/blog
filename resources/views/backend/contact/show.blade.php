<x-layout-admin>
    <x-slot:title>Chi tiết Liên hệ: {{ $contact->name }}</x-slot:title>

    <div class="card bg-white shadow-sm rounded-lg border border-gray-200 p-6">
        <div class="flex justify-between items-center mb-6 border-b pb-4 border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800">Chi tiết Liên hệ: {{ $contact->name }}</h2>
            <a href="{{ route('admin.contacts.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 text-sm font-medium rounded-lg">
                <i class="fas fa-arrow-left mr-2"></i> Quay lại danh sách
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-8 mb-8">
            {{-- Thông tin Liên hệ --}}
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-3 border-b border-gray-100 pb-2">Thông tin Liên hệ</h3>
                <p class="text-gray-700 mb-2">
                    <strong class="text-gray-800">ID:</strong> {{ $contact->id }}
                </p>
                <p class="text-gray-700 mb-2">
                    <strong class="text-gray-800">Tên người gửi:</strong> {{ $contact->name }}
                </p>
                <p class="text-gray-700 mb-2">
                    <strong class="text-gray-800">Email:</strong> {{ $contact->email }}
                </p>
                <p class="text-gray-700 mb-2">
                    <strong class="text-gray-800">Điện thoại:</strong> {{ $contact->phone }}
                </p>
                <p class="text-gray-700 mb-2">
                    <strong class="text-gray-800">Tiêu đề:</strong> {{ $contact->title }}
                </p>
                <p class="text-gray-700 mb-2">
                    <strong class="text-gray-800">Trạng thái:</strong>
                    @if ($contact->status == 1)
                        <span class="font-semibold px-3 py-1 rounded-full text-sm text-blue-700 bg-blue-100">Mới</span>
                    @elseif($contact->status == 2)
                        <span class="font-semibold px-3 py-1 rounded-full text-sm text-yellow-700 bg-yellow-100">Đã
                            xem</span>
                    @else
                        <span class="font-semibold px-3 py-1 rounded-full text-sm text-gray-700 bg-gray-100">Đã xử
                            lý</span>
                    @endif
                </p>
                <p class="text-gray-700 mb-2">
                    <strong class="text-gray-800">Ngày gửi:</strong> {{ $contact->created_at->format('d/m/Y H:i:s') }}
                </p>
                <p class="text-gray-700 mb-2">
                    <strong class="text-gray-800">Ngày cập nhật:</strong>
                    {{ $contact->updated_at->format('d/m/Y H:i:s') }}
                </p>
                <p class="text-gray-700 mb-2">
                    <strong class="text-gray-800">Người cập nhật gần nhất:</strong>
                    {{ $contact->updater->name ?? 'N/A' }}
                </p>
            </div>

            {{-- Nội dung liên hệ --}}
            <div class="col-span-1 md:col-span-2">
                <h3 class="text-lg font-semibold text-gray-800 mb-3 border-b pb-2 border-gray-100">Nội dung Liên hệ</h3>
                <div class="p-4 bg-gray-50 rounded-md text-gray-700 border border-gray-200 min-h-[120px] overflow-auto">
                    {{ $contact->content ?? 'Không có nội dung.' }}
                </div>
            </div>
        </div>

        {{-- Nút hành động --}}
        <div class="text-right mt-6 flex justify-end space-x-3">
            @if ($contact->status == 1)
                {{-- If status is 'Mới' (New), allow to mark as 'Đã xem' --}}
                <form action="{{ route('admin.contacts.update', $contact->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="2"> {{-- Assuming 2 is 'Đã xem' --}}
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg">
                        <i class="fas fa-eye mr-2"></i> Đánh dấu đã xem
                    </button>
                </form>
            @elseif($contact->status == 2)
                {{-- If status is 'Đã xem', allow to mark as 'Đã xử lý' --}}
                <form action="{{ route('admin.contacts.update', $contact->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="0"> {{-- Assuming 0 is 'Đã xử lý' (completed) --}}
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg">
                        <i class="fas fa-check-circle mr-2"></i> Đánh dấu đã xử lý
                    </button>
                </form>
            @endif

            <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" class="inline-block"
                onsubmit="return confirm('Bạn có chắc chắn muốn xóa liên hệ này?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg">
                    <i class="fas fa-trash-alt mr-2"></i> Xóa
                </button>
            </form>
        </div>
    </div>
</x-layout-admin>
