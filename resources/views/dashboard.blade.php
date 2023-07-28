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
                        <div>
                            @if (session('success'))
                            <div style="color: green;">
                                {{ session('success') }}
                            </div>
                            @endif
                            <label>نویسندگان:</label>
                            <button>جدید</button>
                            <button>ویرایش</button>
                            <button>حذف</button>
                        </div>

                        <div>
                            <label>کتاب‌ها:</label>
                            <a href="{{ route('book.create') }}"><button>جدید</button></a>
                            <button>ویرایش</button>
                            <button>حذف</button>
                        </div>

                        <div>
                            <label>انتشارات:</label>
                            <button>جدید</button>
                            <button>ویرایش</button>
                            <button>حذف</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>