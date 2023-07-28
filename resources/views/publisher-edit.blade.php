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
                        <p>فرم ویرایش انتشارات</p>
                        <form action="{{ route('publisher.update', ['id' => $publisher->id]) }}" method="POST">
                            @csrf

                            <label for="title">نام:</label>
                            <input type="text" name="name" value="{{ $publisher->name }}" required>
                            <br>

                            <label for="author">ایمیل:</label>
                            <input type="text" name="email" value="{{ $publisher->email }}" required>
                            <br>

                            <label for="description">تلفن:</label>
                            <input type="text" name="phone" value="{{ $publisher->phone }}" required>
                            <br>

                            <label for="description">استان:</label>
                            <input type="text" name="province" value="{{ $publisher->province }}" required>
                            <br>

                            <label for="author">شهر:</label>
                            <input type="text" name="city" value="{{ $publisher->city }}" required>
                            <br>

                            <label for="author">خیابان:</label>
                            <input type="text" name="street" value="{{ $publisher->street }}" required>
                            <br>

                            <label for="author">کد پستی:</label>
                            <input type="text" name="zipcode" value="{{ $publisher->zipcode }}" required>
                            <br>

                            <button type="submit">ویرایش انتشارات</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>