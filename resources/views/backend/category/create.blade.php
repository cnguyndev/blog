<x-layout-admin>
    <x-slot:title>Tạo Danh mục mới</x-slot:title>

    <div class="card bg-white shadow-sm rounded-lg border border-gray-200 p-6"> {{-- Card container --}}
        <h6 class="text-2xl font-bold mb-4 text-gray-800">Tạo Danh mục mới</h6> {{-- Adjusted heading style --}}

        <form action="{{ route('admin.categories.store') }}" method="POST" class="flex flex-col gap-6">
            {{-- Added gap for spacing --}}
            @csrf

            <div> {{-- Wrapped form fields in div for consistent gap --}}
                <label for="name" class="block text-sm font-semibold mb-2 text-gray-800">Tên danh mục:</label>
                {{-- Adjusted label style --}}
                <input type="text" name="name" id="name"
                    class="py-3 px-4 block w-full border border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0 {{-- New input style --}}
                              @error('name') border-red-500 @enderror"
                    value="{{ old('name') }}" required>
                @error('name')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div> {{-- Wrapped form fields in div --}}
                <label for="slug" class="block text-sm font-semibold mb-2 text-gray-800">Slug:</label>
                {{-- Adjusted label style --}}
                <input type="text" name="slug" id="slug"
                    class="py-3 px-4 block w-full border border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0 {{-- New input style --}}
                              @error('slug') border-red-500 @enderror"
                    value="{{ old('slug') }}">
                @error('slug')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div> {{-- Wrapped form fields in div --}}
                <label for="parent_id" class="block text-sm font-semibold mb-2 text-gray-800">Danh mục cha:</label>
                {{-- Adjusted label style --}}
                <select name="parent_id" id="parent_id"
                    class="py-3 px-4 block w-full border border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0 {{-- New select style --}}
                               @error('parent_id') border-red-500 @enderror">
                    <option value="">-- Chọn danh mục cha --</option>
                    @foreach ($parentCategories as $parentCategory)
                        <option value="{{ $parentCategory->id }}"
                            {{ old('parent_id') == $parentCategory->id ? 'selected' : '' }}>
                            {{ $parentCategory->name }}
                        </option>
                    @endforeach
                </select>
                @error('parent_id')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div> {{-- Wrapped form fields in div --}}
                <label for="status" class="block text-sm font-semibold mb-2 text-gray-800">Trạng thái:</label>
                {{-- Adjusted label style --}}
                <select name="status" id="status"
                    class="py-3 px-4 block w-full border border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0 {{-- New select style --}}
                               @error('status') border-red-500 @enderror"
                    required>
                    <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Hoạt động</option>
                    <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Không hoạt động</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between mt-4"> {{-- Adjusted margin-top --}}
                <button type="submit"
                    class="btn text-sm text-white font-medium px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-md">
                    {{-- New button style --}}
                    Tạo danh mục
                </button>
                <a href="{{ route('admin.categories.index') }}"
                    class="btn text-sm text-gray-800 font-medium px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-md">
                    {{-- New button style --}}
                    Hủy
                </a>
            </div>
        </form>
    </div>
</x-layout-admin>
