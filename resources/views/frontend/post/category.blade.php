<x-layout-app>
    <x-slot:title>Bài viết theo danh mục: {{ $currentCategory->name }}</x-slot:title>

    <div class="container mx-auto px-4 py-8 lg:py-16">
        <div class="flex flex-col lg:flex-row lg:gap-8">
            <div class="w-full lg:w-3/4 mb-8 lg:mb-0">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-8 text-center lg:text-left">
                    Bài viết trong danh mục: <span class="text-blue-600">{{ $currentCategory->name }}</span>
                </h1>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @forelse ($posts as $post)
                        <div class="bg-white rounded-xl shadow-md overflow-hidden">
                            <div class="relative w-full h-48">
                                <img src="{{ asset('frontend/images/posts/' . $post->thumbnail) }}"
                                    alt="{{ $post->title }}" class="h-full w-full object-cover" />
                            </div>
                            <div class="p-6">
                                <p class="text-sm font-medium text-blue-500 mb-2">
                                    {{ $post->category->name ?? 'Chưa phân loại' }}
                                </p>
                                <a href="{{ route('site.post.detail', ['slug' => $post->slug]) }}"
                                    class="block text-xl font-semibold text-blue-gray-900 mb-2 normal-case transition-colors hover:text-red-500">
                                    {{ $post->title }}
                                </a>
                                <div class="flex items-center gap-4">
                                    <i class="fa-solid fa-user text-gray-700 text-lg"></i>
                                    <div>
                                        <p class="text-sm font-medium text-blue-gray-900 mb-0.5">
                                            Lê Trần Chính Nguyên
                                        </p>
                                        <p class="text-xs text-gray-500 font-normal">
                                            {{ $post->created_at->format('d F Y') }} | Lượt xem:
                                            {{ number_format($post->view) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="col-span-full text-center text-gray-600">Chưa có bài viết nào trong danh mục này.</p>
                    @endforelse
                </div>

                <div class="flex justify-center items-center gap-4 mt-12">
                    {{ $posts->links() }}
                </div>
            </div>

            <div class="w-full lg:w-1/4">
                <div class="bg-white p-6 rounded-lg shadow-md sticky top-28">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Bài viết phổ biến</h3>

                    <ul class="space-y-4">
                        @forelse ($popularPosts as $post)
                            <li>
                                <a href="{{ route('site.post.detail', ['slug' => $post->slug]) }}"
                                    class="block text-base font-semibold text-blue-gray-900 normal-case transition-colors hover:text-red-500">
                                    {{ $post->title }}
                                </a>
                                <p class="text-xs text-gray-500 mt-1">Lượt xem: {{ number_format($post->view) }}</p>
                            </li>
                        @empty
                            <li>
                                <p class="text-gray-500">Chưa có bài viết phổ biến nào.</p>
                            </li>
                        @endforelse
                    </ul>

                    <div class="mt-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Danh mục</h3>
                        <ul class="space-y-2">
                            @forelse ($categories as $category)
                                <li>
                                    <a href="{{ route('site.category', $category->slug) }}"
                                        class="text-gray-700 hover:text-red-500 transition-colors
                                               @if (isset($currentCategory)) @if (
                                                   $currentCategory->id === $category->id ||
                                                       (isset($currentCategory->parent_id) &&
                                                           $currentCategory->parent_id !== 0 &&
                                                           isset($currentCategory->parent) &&
                                                           $currentCategory->parent->id === $category->id))
                                                       font-bold @endif
                                               @endif
                                               ">
                                        {{ $category->name }}
                                    </a>

                                    @if ($category->children->count() > 0)
                                        <ul class="ml-4 mt-1 space-y-1">
                                            @foreach ($category->children as $childCategory)
                                                <li>
                                                    <a href="{{ route('site.category', $childCategory->slug) }}"
                                                        class="text-gray-600 hover:text-red-500 transition-colors
                                                               @if (isset($currentCategory) && $currentCategory->id === $childCategory->id) font-bold @endif
                                                               ">
                                                        - {{ $childCategory->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @empty
                                <li>
                                    <p class="text-gray-500">Chưa có danh mục nào.</p>
                                </li>
                            @endforelse
                        </ul>
                    </div>

                    <div class="mt-8 text-center">
                        <a href="#"
                            class="inline-block bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors text-sm font-medium">
                            <i class="fas fa-heart mr-2"></i> Ủng hộ chúng tôi!
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout-app>
