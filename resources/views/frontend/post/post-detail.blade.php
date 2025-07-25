<x-layout-app>
    <x:slot:title>{{ $post['title'] }}</x:slot:title>
    <x:slot:header>
        <style>
            article.post-content {
                font-family: "Segoe UI", Roboto, "Helvetica Neue", sans-serif;
                line-height: 1.75;
                font-size: 17px;
                color: #333;
            }

            article.post-content h2 {
                font-size: 1.75rem;
                margin-top: 2rem;
                margin-bottom: 1rem;
                font-weight: bold;
                color: #1a202c;
                border-left: 4px solid #3182ce;
                padding-left: 12px;
            }

            article.post-content h3 {
                font-size: 1.5rem;
                margin-top: 1.5rem;
                margin-bottom: 0.75rem;
                font-weight: bold;
                color: #2b6cb0;
            }

            article.post-content h4 {
                font-size: 1.25rem;
                margin-top: 1.25rem;
                margin-bottom: 0.5rem;
                font-weight: bold;
                color: #4a5568;
            }

            article.post-content p {
                margin-bottom: 1rem;
                text-align: justify;
            }

            article.post-content ul {
                list-style-type: disc;
                margin-left: 1.5rem;
                margin-bottom: 1rem;
            }

            article.post-content ul li {
                margin-bottom: 0.5rem;
            }

            article.post-content table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 1.5rem;
                font-size: 16px;
            }

            article.post-content table th,
            article.post-content table td {
                border: 1px solid #cbd5e0;
                padding: 10px;
                text-align: left;
            }

            article.post-content table th {
                background-color: #f7fafc;
                font-weight: bold;
            }

            @media (max-width: 768px) {
                article.post-content {
                    font-size: 16px;
                }

                article.post-content h2 {
                    font-size: 1.5rem;
                }

                article.post-content h3 {
                    font-size: 1.25rem;
                }

                article.post-content table {
                    font-size: 14px;
                }
            }
        </style>

    </x:slot:header>
    <div class="container mx-auto px-4 py-8 lg:py-16">
        <div class="flex flex-col lg:flex-row lg:gap-8">
            <div class="w-full lg:w-3/4 mb-8 lg:mb-0">
                <div class="max-w-4xl mx-auto lg:mx-0 bg-white p-6 md:p-8 rounded-lg shadow-md">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 leading-tight">
                        {{ $post['title'] }}
                    </h1>

                    <div class="flex items-center justify-between gap-4 text-gray-600 mb-8">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-user mr-2"></i>
                            <div>
                                <a class="text-sm font-medium text-blue-gray-900 hover:text-red-500 transition-colors"
                                    onclick="window.location='{{ route('site.about') }}'">Lê Trần Chính Nguyên</a>
                                <p class="text-xs text-gray-500">{!! $post['updated_at'] ? 'Cập nhật lần cuối: ' . $post['updated_at'] : 'Đăng lúc: ' . $post['created_at'] !!}</p>
                            </div>
                        </div>
                        <div>
                            <p class="text-sm"><span class="font-medium text-red-500">Số lượt xem:
                                    {{ $post['view'] }}</span></p>
                            <p class="text-sm"><span class="font-medium text-red-500">Danh mục:
                                    {{ $post['category']['name'] }}</span></p>
                        </div>
                    </div>

                    <div class="mb-8">
                        <img src="{{ asset('frontend/images/posts/' . $post['thumbnail']) }}" alt="{{ $post['title'] }}"
                            class="w-full h-auto rounded-lg object-cover">
                    </div>

                    <article class="post-content max-w-none text-gray-700 text-lg leading-relaxed">
                        {!! $post['content'] !!}

                        @if ($post->download && $post->download !== '')
                            <div
                                class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-8">
                                <strong class="font-bold">Lưu ý:</strong>
                                <span class="block sm:inline">Để tải xuống, vui lòng chờ bộ đếm ngược kết thúc.</span>
                            </div>

                            <div class="flex flex-col items-center justify-center bg-gray-50 p-8 rounded-lg shadow-lg">
                                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Tải xuống</h2>

                                <div id="countdown-timer" class="text-5xl font-extrabold text-blue-600 mb-6">
                                    <span id="countdown-minutes">00</span>:<span id="countdown-seconds">10</span>
                                </div>

                                <div id="download-button-wrapper" class="hidden">
                                    @if ($post->password && $post->password !== '')
                                        <div class="mb-4 text-center">
                                            <p class="text-gray-700 text-lg font-medium mb-2">Mật khẩu tải xuống:</p>
                                            <input type="text" value="{{ $post->password }}" readonly
                                                class="px-4 py-2 border border-gray-300 rounded-md bg-white text-gray-800 font-mono text-xl text-center select-all w-full max-w-xs mx-auto"
                                                onclick="this.select(); document.execCommand('copy'); alert('Đã sao chép mật khẩu!');">
                                            <p class="text-sm text-gray-500 mt-1">Click vào ô để sao chép mật khẩu.</p>
                                        </div>
                                    @endif

                                    <a href="{{ $post->download }}" id="download-link"
                                        class="inline-flex items-center px-8 py-4 bg-green-600 hover:bg-green-700 text-white text-xl font-bold rounded-full shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
                                        <i class="fas fa-download mr-3"></i> Tải Xuống Ngay
                                    </a>
                                </div>
                            </div>
                        @endif
                    </article>

                    <div class="mt-12 text-center">
                        <a href="{{ route('site.home') }}"
                            class="inline-flex items-center bg-gray-900 text-white px-6 py-3 rounded-lg hover:bg-gray-800 transition-colors">
                            <i class="fas fa-arrow-left mr-2"></i> Quay lại trang chủ
                        </a>
                    </div>
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
                                               @endif">
                                        {{ $category->name }}
                                    </a>

                                    @if ($category->children->count() > 0)
                                        <ul class="ml-4 mt-1 space-y-1">
                                            @foreach ($category->children as $childCategory)
                                                <li>
                                                    <a href="{{ route('site.category', $childCategory->slug) }}"
                                                        class="text-gray-600 hover:text-red-500 transition-colors
                                                               @if (isset($currentCategory) && $currentCategory->id === $childCategory->id) font-bold @endif">
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

        <section class="mt-16 py-8 px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-blue-gray-900 text-center mb-8">Bài viết cùng danh mục</h2>
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                @forelse ($other as $post)
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
                                    <p class="text-sm font-medium text-blue-gray-900 mb-0.5">Lê Trần Chính Nguyên</p>
                                    <p class="text-xs text-gray-500 font-normal">
                                        {{ $post->created_at->format('d F Y') }} | Lượt xem:
                                        {{ number_format($post->view) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-600">Hiện chưa có bài viết nào trong danh mục này.</p>
                @endforelse
            </div>
        </section>
    </div>

    <x-slot:footer>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const countdownTimerElement = document.getElementById('countdown-timer');
                const countdownMinutesElement = document.getElementById('countdown-minutes');
                const countdownSecondsElement = document.getElementById('countdown-seconds');
                const downloadButtonWrapper = document.getElementById('download-button-wrapper');
                const downloadLink = document.getElementById('download-link');

                let timeLeft = 10;

                if (countdownTimerElement && downloadButtonWrapper && downloadLink) {
                    if (downloadLink.href && downloadLink.href !== window.location.href + '#') {
                        const countdownInterval = setInterval(function() {
                            const minutes = Math.floor(timeLeft / 60);
                            const seconds = timeLeft % 60;

                            countdownMinutesElement.textContent = String(minutes).padStart(2, '0');
                            countdownSecondsElement.textContent = String(seconds).padStart(2, '0');

                            if (timeLeft <= 0) {
                                clearInterval(countdownInterval);
                                countdownTimerElement.style.display = 'none';
                                downloadButtonWrapper.classList.remove('hidden');
                            } else {
                                timeLeft--;
                            }
                        }, 1000);
                    } else {
                        countdownTimerElement.style.display = 'none';
                        downloadButtonWrapper.innerHTML =
                            '<p class="text-red-500 font-semibold">Liên kết tải xuống không khả dụng.</p>';
                        downloadButtonWrapper.classList.remove('hidden');
                    }
                }
            });
        </script>
    </x-slot:footer>
</x-layout-app>
