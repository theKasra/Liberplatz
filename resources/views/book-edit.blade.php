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
                        <p>فرم ویرایش کتاب</p>
                        <form action="{{ route('book.update', ['id' => $book->id]) }}" method="POST">
                            @csrf

                            <label for="title">عنوان:</label>
                            <input type="text" name="title" value="{{ $book->title }}" required>
                            <br>

                            <label for="author">نویسنده:</label>
                            <select name="author" required>
                                <option value="{{ $author[0]->id }}">{{ $author[0]->first_name }} {{ $author[0]->last_name }}</option>
                                @foreach ($authors as $other_author)
                                    @if ($author[0]->id != $other_author->id)
                                        <option value="{{ $other_author->id }}">{{ $other_author->first_name }} {{ $other_author->last_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <br>

                            <label for="isbn">شابک:</label>
                            <input type="text" name="isbn" value="{{ $book->isbn }}" required>
                            <br>

                            <label for="description">توضیحات:</label>
                            <textarea name="description" rows="4" required>{{ $book->description }}</textarea>
                            <br>

                            <label for="pages">تعداد صفحات:</label>
                            <input type="number" name="pages" value="{{ $book->pages }}" required>
                            <br>

                            <label for="publisher">ناشر:</label>
                            <select name="publisher" required>
                                <option value="{{ $publisher->id }}">نشر {{ $publisher->name }}</option>
                                @foreach ($publishers as $other_publisher)
                                    @if ($publisher->id != $other_publisher->id)
                                        <option value="{{ $other_publisher->id }}">نشر {{ $other_publisher->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <br>

                            <label for="year_of_publication">سال انتشار:</label>
                            <input type="date" name="year_of_publication" value="{{ $book->year_of_publication }}" required>
                            <br>

                            <button type="submit">ویرایش کتاب</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>