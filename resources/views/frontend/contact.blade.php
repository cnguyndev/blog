<x-layout-app>
    <x-slot:title>Liên hệ</x-slot:title>

    <section class="px-4 py-16 lg:px-8 lg:py-24 bg-white">
        <div class="container mx-auto text-center">
            <h5 class="mb-4 !text-base lg:!text-2xl text-blue-gray-900">
                Biểu mẫu liên hệ
            </h5>
            <h1 class="mb-4 !text-3xl lg:!text-5xl text-blue-gray-900">
                Chúng tôi luôn sãn sàng
            </h1>
            <p class="mb-10 font-normal !text-lg lg:mb-20 mx-auto max-w-3xl !text-gray-500">
                Dù đó là câu hỏi về dịch vụ của chúng tôi, yêu cầu hỗ trợ kỹ thuật, hay ý kiến đóng góp để cải thiện,
                đội ngũ của chúng tôi rất mong muốn nhận được phản hồi từ bạn.
            </p>
            <div class="grid grid-cols-1 gap-y-10 lg:grid-cols-2 items-start justify-center">

                <div class="w-full h-[300px] lg:h-[510px] rounded-xl overflow-hidden shadow-xl lg:max-w-none mx-auto">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.649318804595!2d106.67104677503792!3d10.76173038938927!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f1e29c8959f%3A0x6b432a51f8936611!2sHo%20Chi%20Minh%20City%20University%20of%20Technology!5e0!3m2!1sen!2s!4v1718956515201!5m2!1sen!2s"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade" class="rounded-xl"></iframe>
                </div>

                <form action="{{ route('site.contact.submit') }}" method="POST"
                    class="flex flex-col gap-6 mx-5 p-4 rounded-lg bg-white">
                    @csrf

                    <p class="text-left !font-semibold !text-gray-600 text-sm">
                        Để lại thông tin để chúng tôi có thể liên hệ với bạn.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <div class="relative h-10 w-full">
                                <input id="first-name" type="text"
                                    class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-black outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-black placeholder-shown:border-t-black focus:border-2 focus:border-black focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50
                                    @error('first_name') border-red-500 @enderror"
                                    placeholder=" " name="first_name" value="{{ old('first_name') }}" />
                                <label for="first-name"
                                    class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-black transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-black before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-black after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-black peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-black peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-black peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-black peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-black">
                                    Họ
                                </label>
                            </div>
                            @error('first_name')
                                <p class="text-red-500 text-xs mt-1 text-left">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <div class="relative h-10 w-full">
                                <input id="last-name" type="text"
                                    class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-black outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-black placeholder-shown:border-t-black focus:border-2 focus:border-black focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50
                                    @error('last_name') border-red-500 @enderror"
                                    placeholder=" " name="last_name" value="{{ old('last_name') }}" />
                                <label for="last-name"
                                    class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-black transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-black before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-black after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-black peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-black peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-black peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-black peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-black">
                                    Tên
                                </label>
                            </div>
                            @error('last_name')
                                <p class="text-red-500 text-xs mt-1 text-left">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <div class="relative h-10 w-full">
                            <input id="email" type="email"
                                class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-black outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-black placeholder-shown:border-t-black focus:border-2 focus:border-black focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50
                                @error('email') border-red-500 @enderror"
                                placeholder=" " name="email" value="{{ old('email') }}" />
                            <label for="email"
                                class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-black transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-black before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-black after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-black peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-black peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-black peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-black peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-black">
                                Email
                            </label>
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1 text-left">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <div class="relative w-full min-w-[200px] h-32">
                            <textarea id="message" rows="6"
                                class="peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-black outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-black placeholder-shown:border-t-black focus:border-2 focus:border-black focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50 resize-none
                                @error('message') border-red-500 @enderror"
                                placeholder=" " name="message">{{ old('message') }}</textarea>
                            <label for="message"
                                class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-black transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-black before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-black after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-black peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-black peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-black peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-black peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-black">
                                Nội dung
                            </label>
                        </div>
                        @error('message')
                            <p class="text-red-500 text-xs mt-1 text-left">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit"
                        class="w-full px-6 py-3 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-colors font-medium text-lg shadow-md">
                        Gửi tin nhắn
                    </button>
                </form>
            </div>
        </div>
    </section>

</x-layout-app>
