<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('backend/assets/img/apple-icon.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('backend/assets/img/favicon.png') }}" />
    <title>Admin Login - NIOO.IO.VN</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    {{-- Removed nucleo-icons.css and nucleo-svg.css as they might conflict or are not needed with Font Awesome and Tailwind --}}

    @vite('resources/css/app.css')
</head>

<body class="m-0 font-sans antialiased font-normal bg-gray-50 text-start text-base leading-default text-gray-700">
    {{-- Consistent body background and text color --}}
    <div class="absolute w-full top-0 z-50">
        <div class="container mx-auto px-3">
            <nav
                class="flex flex-wrap items-center px-4 py-2 mt-6 mb-0 shadow-sm rounded-xl bg-white/80 backdrop-blur-2xl backdrop-saturate-200 lg:flex-nowrap lg:justify-center border border-gray-200">
                {{-- Added border --}}
                <div class="flex items-center justify-center w-full p-0 px-6 mx-auto flex-wrap-inherit">
                    <a class="py-1.75 text-2xl mr-4 ml-4 whitespace-nowrap font-bold text-gray-800 lg:ml-0"
                        {{-- Adjusted font size and color --}} href="{{ route('admin.dashboard') }}" target="_blank"> Admin Panel </a>
                    {{-- Simplified text --}}
                </div>
            </nav>
        </div>
    </div>
    <main class="mt-0 transition-all duration-200 ease-in-out">
        <section>
            <div class="flex items-center justify-center min-h-screen p-0 bg-gray-50"> {{-- Consistent background --}}
                <div class="container z-1 mx-auto py-10">
                    <div class="flex flex-wrap -mx-3 justify-center">
                        <div class="w-full max-w-md px-3 flex justify-center">
                            <div class="card bg-white p-8 rounded-lg shadow-md border border-gray-200 w-full">
                                {{-- Consistent card style --}}

                                <div class="p-0 pb-4 mb-4 border-b border-gray-200"> {{-- Adjusted padding and margin --}}
                                    <h4 class="font-bold text-center text-2xl text-gray-800">Đăng Nhập</h4>
                                    {{-- Adjusted font size and color --}}
                                    <p class="mb-0 text-center text-gray-600 text-sm">Chào mừng bạn trở lại!</p>
                                    {{-- Added a welcome message --}}
                                </div>
                                <div class="flex-auto p-0"> {{-- Removed p-6, using gap in form --}}
                                    <form role="form" method="POST" action="{{ route('admin.login.post') }}"
                                        class="flex flex-col gap-4"> {{-- Added flex-col gap --}}
                                        @csrf

                                        {{-- Dynamic Alert Component for Flash Messages --}}
                                        @if (session('success'))
                                            <x-alert type="success" title="Thành công!"
                                                message="{{ session('success') }}" class="mb-2" />
                                        @endif
                                        @if (session('error'))
                                            <x-alert type="error" title="Lỗi!" message="{{ session('error') }}"
                                                class="mb-2" />
                                        @endif
                                        @if (session('warning'))
                                            <x-alert type="warning" title="Cảnh báo!" message="{{ session('warning') }}"
                                                class="mb-2" />
                                        @endif
                                        @if (session('info'))
                                            <x-alert type="info" title="Thông tin!" message="{{ session('info') }}"
                                                class="mb-2" />
                                        @endif

                                        {{-- Display Validation Errors --}}
                                        @if ($errors->any())
                                            <x-alert type="error" title="Có lỗi xảy ra!"
                                                message="Vui lòng kiểm tra lại thông tin nhập." class="mb-2">
                                                <ul class="mt-2 list-disc list-inside text-sm">
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </x-alert>
                                        @endif

                                        <div>
                                            <label for="email"
                                                class="block text-sm font-semibold mb-2 text-gray-800">Email</label>
                                            {{-- Added label --}}
                                            <input type="email" placeholder="Email" name="email"
                                                value="{{ old('email') }}"
                                                class="py-3 px-4 block w-full border border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0
                                                @error('email') border-red-500 @enderror" />
                                            @error('email')
                                                <p class="text-red-500 text-xs mt-1 text-left">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="password"
                                                class="block text-sm font-semibold mb-2 text-gray-800">Mật khẩu</label>
                                            {{-- Added label --}}
                                            <input type="password" placeholder="Mật khẩu" name="password"
                                                class="py-3 px-4 block w-full border border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0
                                                @error('password') border-red-500 @enderror" />
                                            @error('password')
                                                <p class="text-red-500 text-xs mt-1 text-left">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="text-center mt-4">
                                            <button type="submit"
                                                class="btn text-sm text-white font-medium w-full px-4 py-3 bg-blue-600 hover:bg-blue-700 rounded-lg">Đăng
                                                nhập</button> {{-- Consistent button style --}}
                                        </div>
                                        <p class="text-sm text-center text-gray-600 mt-4">
                                            Bạn chưa có tài khoản?
                                            <a href="#" class="font-semibold text-blue-600 hover:underline">Đăng
                                                ký</a>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    {{-- No specific backend/js/script.js needed for login page unless custom JS is intended --}}
</body>

</html>
