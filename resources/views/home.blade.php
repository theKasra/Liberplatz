<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>خانه - SocialBook</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://cdn.fontcdn.ir/Font/Persian/Vazir/v5.0.2/Vazir.css" type="text/css">
</head>
<body>

  @include('partials._navbar')

  <div class="container">

    @include('partials._right-side-bar')


    <div class="main-content">

      <div class="write-post-container">
        <div class="user-profile">
          <img src="{{ asset('storage/images/profile-pic.png') }}" alt="user-profile">
          <div>
            <p>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
            <small>{{ Auth::user()->name }}@</small>
          </div>
        </div>

        <div class="post-input-container">

          <form action="{{ route('status.store') }}" method="post">
            @csrf
            <select name="book_id">
              @foreach ($books as $book)
                <option value="{{ $book->id }}">{{ $book->title }}</option>
              @endforeach
            </select>

            <span>
              <label style="margin-right: 15px; font-size: 15px;">
                <input type="checkbox" id="statusCheckbox">
                کتاب را خواندم
              </label>
              <input type="hidden" name="status_checkbox_value" id="statusCheckboxValue" value="0">
            </span>

            <textarea name="description" id="description" rows="3" placeholder="درباره کتاب..."></textarea>
            <button type="submit" class="post-status-btn">ارسال</button>
          </form>
        </div>

      </div>

      <!-- POSTS IN FEED -->
        @foreach ($statuses as $status)
          <div class="post-container">
            <div class="user-profile">
              <a href="{{ route('user', ['id' => $status->user_id]) }}">
                <img src="{{ asset('storage/images/profile-pic.png') }}" alt="user-profile">
              </a>
                <div>
                  <a href="{{ route('user', ['id' => $status->user_id]) }}" style="text-decoration: none; color: #626262;">
                    <p>{{ $status->first_name ?? 'Unknown first name' }} {{ $status->last_name ?? 'Unknown last name' }}</p>
                    <p></p>
                    <small>{{ $status->user_name ?? 'Unknown username' }}@</small>
                  </a>
                  <br>
                  <span>{{ $status->created_at }}</span>
                </div>
            </div>

            @if (isset($status->description))
              <p class="post-text">{{ $status->description }}</p>
              <hr style="opacity: 0.25;">
              <a href="{{ route('book', ['id' => $status->book_id]) }}" style="text-decoration: none; color: #626262;">
                <p style="font-size: 13px; padding: 5px; text-align: left;">{{ $status->book_title }}</p>
              </a>
              @if ($status->status == true)
                <p style="font-size: 13px; padding: 5px; text-align: left;">خوانده شد</p>
              @else
                <p style="font-size: 13px; padding: 5px; text-align: left;">خوانده نشد</p>
              @endif
            @else
              @if ($status->status == 0)
                <p class="post-text">کتاب {{ $status->book_title }} را نخوانده ام</p>
              @else
                <p class="post-text">کتاب {{ $status->book_title }} را خوانده ام</p>
              @endif
            @endif

            @if (Auth::user()->id == $status->user_id)
            <div class="post-row">
              <div class="activity-icons">
                <div>
                  <!-- <a href="{{ route('status.destroy', ['id' => $status->id]) }}" onclick="return confirm('آیا از حذف اطمینان دارید؟')"> -->
                  <form action="{{ route('status.destroy', ['id' => $status->id]) }}" method="post">
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

      <button type="button" class="load-more-btn">بارگذاری بیشتر</button>

    </div>

    <div class="left-sidebar"></div>
  </div>

  @include('partials._footer')

  <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>