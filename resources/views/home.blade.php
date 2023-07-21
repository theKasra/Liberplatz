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

    <div class="right-sidebar">
      <div class="imp-links">
        <a href="#"><img src="images/publishers.png" alt="pubs-img"></a>
        <a href="#"><img src="images/publishers.png" alt="pubs-img"></a>
        <a href="#"><img src="images/publishers.png" alt="pubs-img"></a>
        <a href="#"><img src="images/publishers.png" alt="pubs-img"></a>
        <a href="#"><img src="images/publishers.png" alt="pubs-img"></a>
      </div>
    </div>


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

          <form action="{{ route('create.status') }}" method="post">
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
      @foreach ($books as $book)
        @foreach ($book->users_status as $status)
          <div class="post-container">
            <div class="user-profile">
              <img src="{{ asset('storage/images/profile-pic.png') }}" alt="user-profile">
                <div>
                  <p>{{ $status->first_name ?? 'Unknown first name' }} {{ $status->last_name ?? 'Unknown last name' }}</p>
                  <p></p>
                  <small>{{ $status->name ?? 'Unknown username' }}@</small>
                  <br>
                  <span>{{ $status->pivot->created_at }}</span>
                </div>
            </div>

            @if (isset($status->pivot->description))
              <p class="post-text">{{ $status->pivot->description }}</p>
              <hr style="opacity: 0.25;">
              <p style="font-size: 13px; padding: 5px; text-align: left;">{{ $book->title }}</p>
            @else
              @if ($status->pivot->status == 0)
                <p class="post-text">کتاب {{ $book->title }} را نخوانده ام</p>
              @else
                <p class="post-text">کتاب {{ $book->title }} را خوانده ام</p>
              @endif
            @endif

            <div class="post-row">
              <div class="activity-icons">
                <div><img src="{{ asset('storage/images/comments.png') }}" alt="comments-img">دیدگاه ها</div>
              </div>
            </div>

          </div>
        @endforeach
      @endforeach

      <button type="button" class="load-more-btn">بارگذاری بیشتر</button>

    </div>

    <div class="left-sidebar"></div>
  </div>

  @include('partials._footer')

  <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>