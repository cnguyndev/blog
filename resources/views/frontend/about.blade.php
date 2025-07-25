<x-layout-app>
    <x-slot:title>Về chúng tôi</x-slot:title>
    <x-slot:header>
        <style>
            body {
                font-family: 'Roboto', sans-serif;
            }

            .prose h1 {
                font-size: 2.25rem;
                font-weight: 700;
                margin-bottom: 1.5rem;
            }

            .prose h2 {
                font-size: 1.875rem;
                font-weight: 600;
                margin-top: 2.5rem;
                margin-bottom: 1.25rem;
            }

            .prose h3 {
                font-size: 1.5rem;
                font-weight: 600;
                margin-top: 2rem;
                margin-bottom: 1rem;
            }

            .prose p {
                margin-bottom: 1.25rem;
            }

            .prose ul {
                list-style: disc;
                margin-left: 1.5rem;
                margin-bottom: 1.25rem;
            }

            .prose ol {
                list-style: decimal;
                margin-left: 1.5rem;
                margin-bottom: 1.25rem;
            }

            .prose li {
                margin-bottom: 0.5rem;
            }

            .prose strong {
                font-weight: 700;
            }

            .prose a {
                color: #3b82f6;
                text-decoration: underline;
            }
        </style>
    </x-slot:header>
    <section class="container mx-auto px-8 py-16 lg:py-24">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6">Về chúng tôi</h1>
            <p class="text-gray-700 text-lg leading-relaxed mb-8">
                Chào mừng bạn đến với NIOO.IO.VN - nơi chia sẻ kiến thức và phần mềm. Chúng tôi là một đội ngũ đam mê
                công nghệ, luôn tìm kiếm và cung cấp những giải pháp phần mềm tốt nhất cùng với những bài viết chất
                lượng cao để giúp bạn nâng cao kỹ năng và hiểu biết.
            </p>
            <p class="text-gray-700 text-lg leading-relaxed mb-12">
                Với sứ mệnh mang đến giá trị thực sự cho cộng đồng, chúng tôi cam kết cung cấp nội dung chính xác, dễ
                hiểu và luôn cập nhật những xu hướng mới nhất trong lĩnh vực công nghệ thông tin. Hãy cùng chúng tôi
                khám phá thế giới số!
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left">
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Sứ mệnh của chúng tôi</h3>
                    <p class="text-gray-700 leading-relaxed">
                        Cung cấp các công cụ và kiến thức cần thiết để mọi người có thể làm chủ công nghệ, từ những
                        người mới bắt đầu đến các chuyên gia. Chúng tôi tin rằng công nghệ là chìa khóa để mở ra tiềm
                        năng vô hạn.
                    </p>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Giá trị cốt lõi</h3>
                    <ul class="list-disc list-inside text-gray-700 leading-relaxed">
                        <li>Đổi mới không ngừng</li>
                        <li>Chất lượng là ưu tiên hàng đầu</li>
                        <li>Minh bạch và đáng tin cậy</li>
                        <li>Hỗ trợ cộng đồng</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

</x-layout-app>
