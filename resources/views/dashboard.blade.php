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
                            <div style="color: green; margin-bottom: 10px;">
                                {{ session('success') }}
                            </div>
                            @endif
                            <label>نویسندگان:</label>
                            <a href="{{ route('author.create') }}"><button>جدید</button></a>
                            <a href="{{ route('author.edit.list') }}"><button>ویرایش</button></a>
                            <a href="{{ route('author.delete.list') }}"><button>حذف</button></a>
                        </div>

                        <div>
                            <label>کتاب‌ها:</label>
                            <a href="{{ route('book.create') }}"><button>جدید</button></a>
                            <a href="{{ route('book.edit.list') }}"><button>ویرایش</button></a>
                            <a href="{{ route('book.delete.list') }}"><button>حذف</button></a>
                        </div>

                        <div>
                            <label>انتشارات:</label>
                            <a href="{{ route('publisher.create') }}"><button>جدید</button></a>
                            <a href="{{ route('publisher.edit.list') }}"><button>ویرایش</button></a>
                            <button>حذف</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>