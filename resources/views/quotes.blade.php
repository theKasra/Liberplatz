<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@ {{ $user->name }} - {{ $user->first_name }} {{ $user->last_name }}</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://cdn.fontcdn.ir/Font/Persian/Vazir/v5.0.2/Vazir.css" type="text/css">
</head>

<body>

  @include('partials._navbar')

  <div class="profile-container">

    @include('partials._profile-detail-info')

      <div class="post-column">

      <div class="write-post-container">
          <div class="user-profile">
            <div>
              <h2>بریده ها</h2>
            </div>
          </div>
        </div>

        @if (Auth::user()->id == $user->id)
        <div class="write-post-container">
          <div class="user-profile">
            <img src="{{ asset('storage/images/profile-pic.png') }}" alt="user-profile">
            <div>
              <p>{{ $user->first_name }} {{ $user->last_name }}</p>
              <small>{{ $user->name }}@</small>
            </div>
          </div>

          <div class="post-input-container">

            <form action="{{ route('quote.store') }}" method="post">
              @csrf
              <select name="book_id">
                @foreach ($books as $book)
                <option value="{{ $book->id }}">{{ $book->title }}</option>
                @endforeach
              </select>

              <textarea name="description" id="description" rows="3" placeholder="بریده ای از کتاب..."></textarea>
              <button type="submit" class="post-status-btn">ارسال</button>
            </form>
          </div>

        </div>
        @endif

        <!-- QUOTES -->
        

        @foreach ($quotes as $quote)
          <div class="post-container">
            <div class="user-profile">
              <img src="{{ asset('storage/images/profile-pic.png') }}" alt="user-profile">
              <div>
                <p>{{ $user->first_name ?? 'Unknown first name' }} {{ $user->last_name ?? 'Unknown last name' }}</p>
                <p></p>
                <small>{{ $user->name ?? 'Unknown username' }}@</small>
                <br>
                <span>{{ $quote->created_at }}</span>
                </div>
              </div>

              <p style="font-style: italic; padding: 5px;">«{{ $quote->quote }}» —<a href="{{ route('book', ['id' => $quote->book_id]) }}">{{ $quote->book_title }}</a></p>

            @if (Auth::user()->id == $quote->user_id)
            <div class="post-row">
              <div class="activity-icons">
                <div>
                  <form action="{{ route('quote.destroy', ['id' => $quote->id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background-color: transparent; border: none; padding: 0; cursor: pointer;" onclick="return confirm('آیا از حذف اطمینان دارید؟')">
                      <img src="{{ asset('storage/images/delete.png') }}" alt="comments-img">حذف
                    </button>
                  </form>
                </div>
              </div>
            </div>
            @endif

          </div>
        @endforeach

      </div>
    </div>

  </div>
  </div>

  @include('partials._footer')

  <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>