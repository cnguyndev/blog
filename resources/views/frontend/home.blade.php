<x-layout-app>
    <x-slot:title>Trang chủ</x-slot:title>
    <x-slot:header>
        <style>
            #tabs-header .active-tab {
                background-color: white;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            }
        </style>
    </x-slot:header>
    <section class="grid place-items-center p-4 sm:p-8">
        <div class="w-full container mx-auto px-4 pt-12 pb-24 text-center">
            <h1
                class="mx-auto w-full text-[30px] lg:text-[48px] font-bold leading-[45px] lg:leading-[60px] lg:max-w-2xl text-blue-gray-900">
                NIOO.IO.VN
            </h1>
            <p
                class="mx-auto mt-8 mb-4 w-full px-4 sm:px-8 !text-gray-700 lg:w-10/12 lg:px-12 xl:w-8/12 xl:px-20 text-lg">
                Website chia sẻ các phần mềm đồ họa, văn phòng, game việt hóa và những thủ thuật máy tính.
            </p>
            <div class="grid place-items-center justify-center gap-2">
                <form action="{{ route('site.post.search') }}" method="GET"
                    class="mt-8 flex flex-col items-center justify-center gap-4 md:flex-row">
                    <div class="w-80">
                        <div class="relative h-10 w-full min-w-[200px]">
                            <input type="text" name="query"
                                class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-black outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-black placeholder-shown:border-t-black focus:border-2 focus:border-black focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                                placeholder=" " value="{{ request('query') }}" />
                            <label
                                class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-black transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-black before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-black after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-black peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-black peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-black peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-black peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-black">
                                Tìm kiếm...
                            </label>
                        </div>
                    </div>
                    <button type="submit"
                        class="px-4 py-2 rounded-lg bg-gray-900 text-white lg:w-max shrink-0 w-full hover:bg-gray-800 transition-colors">
                        Tìm kiếm
                    </button>
                </form>
            </div>
        </div>
    </section>

    <section class="container mx-auto px-4 sm:px-8 py-20 flex flex-col items-center">
        <h1 class="text-4xl font-bold">Bài viết mới nhất</h1>
        <p class=" mb-10 text-center text-gray-500 text-lg">
            Dùng công cụ tìm kiếm phía trên để tìm phần mềm nhanh nhất nhé!
        </p>
        <div class="mx-auto max-w-7xl w-full mb-16">
            <div class="w-full flex mb-8 flex-col items-center">
                <div class="h-[50px] w-full md:w-[50rem] border border-white/25 bg-opacity-90 rounded-lg flex flex-wrap justify-center items-center p-1 gap-2 bg-gray-100"
                    id="tabs-header">
                    @foreach ($categories as $item)
                        <button
                            class="px-4 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-white transition-colors duration-300 w-full sm:w-auto"
                            data-tab-target="{{ $item->slug }}">
                            {{ $item->name }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        <div id="tab-content-wrapper">
            @foreach ($categories as $category)
                <div id="tab-content-{{ $category->slug }}"
                    class="tab-content container my-auto grid grid-cols-1 gap-x-8 gap-y-16 items-start lg:grid-cols-3 px-4 {{ $loop->first ? '' : 'hidden' }}">

                    @php
                        $postsInThisTab = $categorizedPosts[$category->slug] ?? collect();
                    @endphp

                    @forelse ($postsInThisTab as $post)
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
                        <p class="col-span-full text-center text-gray-600">Hiện chưa có bài viết nào trong danh mục này.
                        </p>
                    @endforelse
                </div>
            @endforeach
        </div>
        <button id="view-more-button"
            class="flex items-center gap-2 mt-10 text-gray-900 text-lg font-medium px-4 py-2 hover:bg-gray-100 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" class="w-5 h-5 font-bold text-gray-900">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19.5 5.25l-7.5 7.5-7.5-7.5m15 6l-7.5 7.5-7.5-7.5" />
            </svg>
            Xem thêm
        </button>
    </section>

    <section class="container mx-auto px-4 sm:px-8 py-20 flex flex-col items-center">

        <h2 class="text-3xl md:text-4xl font-bold text-blue-gray-900 text-center lg:text-left">Bài viết nổi bật</h2>



        <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-3">
            @foreach ($popularPosts as $post)
                <div class="relative flex w-full flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                    <div
                        class="relative mx-4 mt-4 overflow-hidden rounded-none bg-white bg-clip-border text-gray-700 shadow-none">
                        <a href="{{ route('site.post.detail', ['slug' => $post->slug]) }}"> <img
                                src="{{ asset('frontend/images/posts/' . $post->thumbnail) }}"
                                alt="{{ $post->title }}" class="h-48 w-full object-cover" /></a>
                        <p class="mt-4 block font-sans text-sm font-medium leading-normal text-blue-500 antialiased">
                            {{ $post->category->name ?? 'Không danh mục' }}
                        </p>
                        <a href="{{ route('site.post.detail', ['slug' => $post->slug]) }}"
                            class="mb-2 mt-1 block font-sans text-[20px] font-bold leading-snug tracking-normal text-blue-gray-900 antialiased hover:text-red-500 transition-colors">
                            {{ $post->title }}
                        </a>
                    </div>
                    <div class="p-4 pt-0">
                        <p class="block font-sans text-base font-normal leading-relaxed text-gray-600 antialiased">
                            {{ $post->created_at->format('d F Y') }}
                            <br>
                            {{ Str::limit(strip_tags($post->content), 100) }}
                        </p>
                    </div>
                    <div class="p-4 pt-0">
                        <button onclick="window.location='{{ route('site.post.detail', ['slug' => $post->slug]) }}'"
                            class="select-none rounded-lg bg-blue-500 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-blue-500/20 transition-all hover:shadow-lg hover:shadow-blue-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                            type="button">
                            Đọc thêm
                        </button>
                    </div>
                </div>
            @endforeach

        </div>
        <button onclick="window.location.href='{{ route('site.post') }}'"
            class="flex items-center gap-2 mt-10 text-gray-900 text-lg font-medium px-4 py-2 hover:bg-gray-100 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" class="w-5 h-5 font-bold text-gray-900">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19.5 5.25l-7.5 7.5-7.5-7.5m15 6l-7.5 7.5-7.5-7.5" />
            </svg>
            Xem toàn bộ
        </button>
    </section>
    <section class="container mx-auto px-4 py-8 lg:py-16">
        <h2 class="text-3xl md:text-4xl font-bold text-blue-gray-900 text-center lg:text-left">
            @if ($randomPosts->isNotEmpty() && isset($randomPosts->first()->category->name))
                {{ $randomPosts->first()->category->name }}
            @else
                Có thể bạn quan tâm
            @endif
        </h2>
        <div class="space-y-12 mt-5">

            @foreach ($randomPosts as $post)
                <div class="flex flex-col md:flex-row bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="md:w-1/2">
                        <a href="{{ route('site.post.detail', ['slug' => $post->slug]) }}"><img
                                src="{{ asset('frontend/images/posts/' . $post->thumbnail) }}"
                                alt="{{ $post->title }}" class="w-full h-64 object-cover"></a>
                    </div>
                    <div class="md:w-1/2 p-6 flex flex-col justify-center">
                        <a href="{{ route('site.post.detail', ['slug' => $post->slug]) }}"
                            class="text-2xl font-bold text-gray-900 mb-2 hover:text-red-500 transition-colors">{{ $post->title }}</a>
                        <p class="text-gray-700 mb-4 leading-relaxed">
                            {{ Str::limit(strip_tags($post->content), 200) }}
                        </p>
                        <p class="text-sm text-gray-500 mb-4">{{ $post->created_at->format('M d, Y') }}</p>
                        <a href="{{ route('site.post.detail', ['slug' => $post->slug]) }}"
                            class="text-blue-600 hover:underline font-medium">Xem thêm</a>
                    </div>
                </div>
            @endforeach

        </div>
    </section>
    <x-slot:footer>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const tabsHeader = document.getElementById('tabs-header');
                const tabButtons = tabsHeader.querySelectorAll('button[data-tab-target]');
                const tabContents = document.querySelectorAll('.tab-content');
                const viewMoreButton = document.getElementById('view-more-button');

                let currentActiveTabSlug = '';

                function activateTab(targetSlug) {
                    currentActiveTabSlug = targetSlug;

                    tabButtons.forEach(btn => btn.classList.remove('active-tab'));

                    tabContents.forEach(content => content.classList.add('hidden'));

                    const clickedButton = tabsHeader.querySelector(`button[data-tab-target="${targetSlug}"]`);
                    if (clickedButton) {
                        clickedButton.classList.add('active-tab');
                    }

                    const targetContent = document.getElementById(`tab-content-${targetSlug}`);
                    if (targetContent) {
                        targetContent.classList.remove('hidden');
                    }
                }
                tabButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const targetTabSlug = this.dataset.tabTarget;
                        activateTab(targetTabSlug);
                    });
                });

                if (tabButtons.length > 0) {
                    const initialTabSlug = tabButtons[0].dataset.tabTarget;
                    activateTab(initialTabSlug);
                }

                if (viewMoreButton) {
                    viewMoreButton.addEventListener('click', function() {
                        if (currentActiveTabSlug) {
                            const categoryBaseUrl =
                                "{{ route('site.category', ['slug' => 'PLACEHOLDER_SLUG']) }}";
                            const finalUrl = categoryBaseUrl.replace('PLACEHOLDER_SLUG', currentActiveTabSlug);
                            window.location.href = finalUrl;
                        }
                    });
                }
            });
        </script>
    </x-slot:footer>
</x-layout-app>
