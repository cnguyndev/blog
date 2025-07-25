<x-layout-admin>
    <x-slot:title>Chỉnh sửa Bài viết: {{ $post->title }}</x-slot:title>

    <div class="card bg-white shadow-sm rounded-lg border border-gray-200 p-6">
        <h6 class="text-2xl font-bold mb-4 text-gray-800">Chỉnh sửa Bài viết: <span
                class="text-blue-600">{{ $post->title }}</span></h6>

        <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data"
            class="flex flex-col gap-6">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-sm font-semibold mb-2 text-gray-800">Tiêu đề:</label>
                <input type="text" name="title" id="title"
                    class="py-3 px-4 block w-full border border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0
                              @error('title') border-red-500 @enderror"
                    value="{{ old('title', $post->title) }}" required>
                @error('title')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="slug" class="block text-sm font-semibold mb-2 text-gray-800">Slug:</label>
                <input type="text" name="slug" id="slug"
                    class="py-3 px-4 block w-full border border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0
                              @error('slug') border-red-500 @enderror"
                    value="{{ old('slug', $post->slug) }}">
                @error('slug')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="category_id" class="block text-sm font-semibold mb-2 text-gray-800">Danh mục:</label>
                <select name="category_id" id="category_id"
                    class="py-3 px-4 block w-full border border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0
                               @error('category_id') border-red-500 @enderror"
                    required>
                    <option value="">-- Chọn danh mục --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="thumbnail" class="block text-sm font-semibold mb-2 text-gray-800">Ảnh thumbnail:</label>
                @if ($post->thumbnail)
                    <img src="{{ asset('frontend/images/posts/' . $post->thumbnail) }}" alt="Current Thumbnail"
                        class="w-32 h-32 object-cover mb-2 rounded-md border border-gray-200 p-1 shadow-sm">
                @endif
                <input type="file" name="thumbnail" id="thumbnail"
                    class="block w-full text-sm text-gray-900 border border-gray-200 rounded-md cursor-pointer bg-gray-50 focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                @error('thumbnail')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="content" class="block text-sm font-semibold mb-2 text-gray-800">Nội dung:</label>
                <textarea name="content" id="content" rows="10"
                    class="py-3 px-4 block w-full border border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0
                                 @error('content') border-red-500 @enderror"
                    required>{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="download" class="block text-sm font-semibold mb-2 text-gray-800">Link Download:</label>
                <input type="text" name="download" id="download"
                    class="py-3 px-4 block w-full border border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0
                              @error('download') border-red-500 @enderror"
                    value="{{ old('download', $post->download) }}">
                @error('download')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-semibold mb-2 text-gray-800">Mật khẩu (nếu có):</label>
                <input type="text" name="password" id="password"
                    class="py-3 px-4 block w-full border border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0
                              @error('password') border-red-500 @enderror"
                    value="{{ old('password', $post->password) }}">
                @error('password')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="status" class="block text-sm font-semibold mb-2 text-gray-800">Trạng thái:</label>
                <select name="status" id="status"
                    class="py-3 px-4 block w-full border border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0
                               @error('status') border-red-500 @enderror"
                    required>
                    <option value="1" {{ old('status', $post->status) == 1 ? 'selected' : '' }}>Đã xuất bản
                    </option>
                    <option value="0" {{ old('status', $post->status) == 0 ? 'selected' : '' }}>Bản nháp</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between mt-4">
                <button type="submit"
                    class="btn text-sm text-white font-medium px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-md">
                    Cập nhật bài viết
                </button>
                <a href="{{ route('admin.posts.index') }}"
                    class="btn text-sm text-gray-800 font-medium px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-md">
                    Hủy
                </a>
            </div>
        </form>
    </div>
    <x-slot:footer>
        <script src="https://cdn.tiny.cloud/1/YOUR_TINYMCE_API_KEY/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                selector: '#content',
                plugins: 'advlist autolink lists link image charmap print preview anchor',
                toolbar_mode: 'floating',
                tinycomments_mode: 'embedded',
                tinycomments_author: 'Author name',
            });
        </script>
    </x-slot:footer>
</x-layout-admin>
