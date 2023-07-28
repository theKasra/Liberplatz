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
                        <p style="margin-bottom: 15px;">لیست کتاب ها برای ویرایش</p>
                        <hr style="margin-bottom: 5px;">
                        @foreach ($books as $book)
                        <ul>
                            <li style="padding: 5px;">
                                <a href="{{ route('book.edit', ['id' => $book->id])}} ">{{ $book->title }}</a>
                            </li>
                        </ul>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>