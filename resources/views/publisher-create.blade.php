<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('پنل مدیریت') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- {{ __("You're logged in!") }} -->
                    <div class="dashboard-container">
                        <p>فرم ایجاد انتشارات</p>
                        <form action="{{ route('publisher.store') }}" method="POST">
                            @csrf

                            <label for="title">نام:</label>
                            <input type="text" name="name" required>
                            <br>

                            <label for="author">ایمیل:</label>
                            <input type="text" name="email" required>
                            <br>

                            <label for="author">تلفن:</label>
                            <input type="text" name="phone" required>
                            <br>

                            <label for="author">استان:</label>
                            <input type="text" name="province" required>
                            <br>

                            <label for="author">شهر:</label>
                            <input type="text" name="city" required>
                            <br>

                            <label for="author">خیابان:</label>
                            <input type="text" name="street" required>
                            <br>

                            <label for="author">کد پستی:</label>
                            <input type="text" name="zipcode" required>
                            <br>

                            <button type="submit">ایجاد انتشارات</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>