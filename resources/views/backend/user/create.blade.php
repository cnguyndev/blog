<x-layout-admin>
    <x-slot:title>Tạo Người dùng mới</x-slot:title>

    <div class="card bg-white shadow-sm rounded-lg border border-gray-200 p-6">
        <h6 class="text-2xl font-bold mb-4 text-gray-800">Tạo Người dùng mới</h6>

        <form action="{{ route('admin.users.store') }}" method="POST" class="flex flex-col gap-6"
            enctype="multipart/form-data">
            @csrf

            <div>
                <label for="name" class="block text-sm font-semibold mb-2 text-gray-800">Tên người dùng:</label>
                <input type="text" name="name" id="name"
                    class="py-3 px-4 block w-full border border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0
                              @error('name') border-red-500 @enderror"
                    value="{{ old('name') }}" required>
                @error('name')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-semibold mb-2 text-gray-800">Email:</label>
                <input type="email" name="email" id="email"
                    class="py-3 px-4 block w-full border border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0
                              @error('email') border-red-500 @enderror"
                    value="{{ old('email') }}" required>
                @error('email')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-semibold mb-2 text-gray-800">Mật khẩu:</label>
                <input type="password" name="password" id="password"
                    class="py-3 px-4 block w-full border border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0
                              @error('password') border-red-500 @enderror"
                    required>
                @error('password')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-semibold mb-2 text-gray-800">Xác nhận mật
                    khẩu:</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="py-3 px-4 block w-full border border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0"
                    required>
            </div>

            <div>
                <label for="fullname" class="block text-sm font-semibold mb-2 text-gray-800">Họ và
                    tên:</label>
                <input type="text" name="fullname" id="fullname"
                    class="py-3 px-4 block w-full border border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0
                              @error('fullname') border-red-500 @enderror"
                    value="{{ old('fullname') }}">
                @error('fullname')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="gender" class="block text-sm font-semibold mb-2 text-gray-800">Giới tính:</label>
                <select name="gender" id="gender"
                    class="py-3 px-4 block w-full border border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0
                               @error('gender') border-red-500 @enderror">
                    <option value="">-- Chọn giới tính --</option>
                    <option value="1" {{ old('gender') == '1' ? 'selected' : '' }}>Nam</option>
                    <option value="0" {{ old('gender') == '0' ? 'selected' : '' }}>Nữ</option>
                </select>
                @error('gender')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="thumbnail" class="block text-sm font-semibold mb-2 text-gray-800">Ảnh đại diện:</label>
                <input type="file" name="thumbnail" id="thumbnail"
                    class="block w-full text-sm text-gray-900 border border-gray-200 rounded-md cursor-pointer bg-gray-50 focus:outline-none file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                @error('thumbnail')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="phone" class="block text-sm font-semibold mb-2 text-gray-800">Điện thoại:</label>
                <input type="text" name="phone" id="phone"
                    class="py-3 px-4 block w-full border border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0
                              @error('phone') border-red-500 @enderror"
                    value="{{ old('phone') }}">
                @error('phone')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="address" class="block text-sm font-semibold mb-2 text-gray-800">Địa chỉ:</label>
                <textarea name="address" id="address" rows="3"
                    class="py-3 px-4 block w-full border border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0
                              @error('address') border-red-500 @enderror">{{ old('address') }}</textarea>
                @error('address')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="roles" class="block text-sm font-semibold mb-2 text-gray-800">Vai trò:</label>
                <select name="roles" id="roles"
                    class="py-3 px-4 block w-full border border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0
                               @error('roles') border-red-500 @enderror">
                    <option value="0" {{ old('roles') == '0' ? 'selected' : '' }}>Khách hàng</option>
                    <option value="1" {{ old('roles') == '1' ? 'selected' : '' }}>Quản trị viên</option>
                </select>
                @error('roles')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="status" class="block text-sm font-semibold mb-2 text-gray-800">Trạng thái:</label>
                <select name="status" id="status"
                    class="py-3 px-4 block w-full border border-gray-200 rounded-md text-sm focus:border-blue-600 focus:ring-0
                               @error('status') border-red-500 @enderror"
                    required>
                    <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Hoạt động</option>
                    <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Không hoạt động</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between mt-4">
                <button type="submit"
                    class="btn text-sm text-white font-medium px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-md">
                    Tạo người dùng
                </button>
                <a href="{{ route('admin.users.index') }}"
                    class="btn text-sm text-gray-800 font-medium px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-md">
                    Hủy
                </a>
            </div>
        </form>
    </div>
</x-layout-admin>
