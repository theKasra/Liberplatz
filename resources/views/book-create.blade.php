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
                        <p>فرم ایجاد کتاب</p>
                        <form action="{{ route('book.store') }}" method="POST">
                            @csrf

                            <label for="title">عنوان:</label>
                            <input type="text" name="title" required>
                            <br>

                            <label for="author">نویسنده:</label>
                            <select name="author" required>
                                @foreach ($authors as $author)
                                <option value="{{ $author->id }}">{{ $author->first_name }} {{ $author->last_name }}</option>
                                @endforeach
                            </select>
                            <br>

                            <label for="isbn">شابک:</label>
                            <input type="text" name="isbn" required>
                            <br>

                            <label for="description">توضیحات:</label>
                            <textarea name="description" rows="4" required></textarea>
                            <br>

                            <label for="pages">تعداد صفحات:</label>
                            <input type="number" name="pages" required>
                            <br>

                            <label for="publisher">ناشر:</label>
                            <select name="publisher" required>
                                @foreach ($publishers as $publisher)
                                    <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                                @endforeach
                            </select>
                            <br>

                            <label for="year_of_publication">سال انتشار:</label>
                            <input type="date" name="year_of_publication" required>
                            <br>

                            <button type="submit">ایجاد کتاب</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>