<x-layout-admin>
    <x-slot:title>Quản lý Liên hệ</x-slot:title>

    <div class="card bg-white shadow-sm rounded-lg border border-gray-200 p-6">
        <div class="flex justify-between items-center mb-4 border-b pb-4 border-gray-200">
            <div>
                <h6 class="text-gray-800 text-xl font-bold">Liên hệ</h6>
                <nav aria-label="breadcrumb" class="text-sm font-medium text-gray-500">
                    <ol class="flex items-center space-x-1">
                        <li><a href="{{ route('admin.dashboard') }}" class="hover:underline">Trang chủ</a></li>
                        <li><i class="fas fa-chevron-right text-xs"></i></li>
                        <li>Liên hệ</li>
                    </ol>
                </nav>
            </div>
            <div class="flex space-x-3 items-center">
                <div class="relative w-48">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400 text-sm"></i>
                    </div>
                    <input type="text" placeholder="Tìm kiếm liên hệ..."
                        class="w-full pl-10 pr-4 py-2 rounded-md border border-gray-300 focus:border-blue-400 focus:ring-blue-400 focus:ring-1 text-sm">
                </div>
                {{-- No 'create' route for contacts in your routes/web.php --}}
                <a href="{{ route('admin.contacts.trash') }}"
                    class="inline-flex items-center px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white text-sm font-medium rounded-lg">
                    <i class="fa-solid fa-trash mr-2 text-base"></i> Thùng rác ({{ $trashCount ?? 0 }})
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border-collapse text-slate-600">
                <thead class="align-bottom">
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b border-gray-200">
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Tên</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Nội dung (tóm tắt)</th>
                        <th class="px-4 py-3">Trạng thái</th>
                        <th class="px-4 py-3">Ngày gửi</th>
                        <th class="px-4 py-3">Người cập nhật</th>
                        <th class="px-4 py-3 text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse ($contacts as $contact)
                        <tr class="text-gray-700 hover:bg-gray-50">
                            <td class="py-3 px-6 text-left whitespace-nowrap">{{ $contact->id }}</td>
                            <td class="py-3 px-6 text-left">{{ $contact->name }}</td>
                            <td class="py-3 px-6 text-left">{{ $contact->email }}</td>
                            <td class="py-3 px-6 text-left">{{ Str::limit($contact->content, 50) }}</td>
                            <td class="py-3 px-6 text-left">
                                <span
                                    class="px-2 py-1 rounded-full text-xs font-semibold
                                    @if ($contact->status == 1) bg-blue-100 text-blue-800 @elseif($contact->status == 2) bg-yellow-100 text-yellow-800 @else bg-gray-100 text-gray-800 @endif">
                                    @if ($contact->status == 1)
                                        Mới
                                    @elseif($contact->status == 2)
                                        Đã xem
                                    @else
                                        Đã xử lý
                                    @endif
                                </span>
                            </td>
                            <td class="py-3 px-6 text-left">{{ $contact->created_at->format('d/m/Y') }}</td>
                            <td class="py-3 px-6 text-left">{{ $contact->updater->name ?? 'N/A' }}</td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center space-x-2">
                                    <a href="{{ route('admin.contacts.show', $contact->id) }}" title="Xem chi tiết"
                                        class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors duration-150">
                                        <i class="fas fa-eye mr-1"></i> Xem
                                    </a>
                                    <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST"
                                        onsubmit="return confirm('Bạn có chắc muốn xóa liên hệ này?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Xóa"
                                            class="inline-flex items-center text-sm font-medium text-red-600 hover:text-red-800 transition-colors duration-150">
                                            <i class="fas fa-trash-alt mr-1"></i> Xóa
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-3 px-6 text-center">Không có liên hệ nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $contacts->links() }}
        </div>
    </div>
</x-layout-admin>
