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
                        <p>فرم ایجاد نویسنده</p>
                        <form action="{{ route('author.store') }}" method="POST">
                            @csrf

                            <label for="title">نام:</label>
                            <input type="text" name="first_name" required>
                            <br>

                            <label for="author">نام خانوادگی:</label>
                            <input type="text" name="last_name" required>
                            <br>

                            <label for="description">زندگی نامه:</label>
                            <textarea name="biography" rows="4" required></textarea>
                            <br>

                            <button type="submit">ایجاد نویسنده</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>