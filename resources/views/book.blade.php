<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>کتاب {{ $book->title }}</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://cdn.fontcdn.ir/Font/Persian/Vazir/v5.0.2/Vazir.css" type="text/css">
</head>

<body>

  @include('partials._navbar')

  <div class="container">

    @include('partials._right-side-bar')

    <div class="main-content">

      <div class="write-post-container">

        <div class="book-container">
          <img src="{{ asset('storage/images/book.jpg') }}" alt="book-img">
        </div>

        <h2>{{ $book->title }}</h2>

        <div class="book-details">
          <p><strong>شابک: </strong>{{ $book->isbn }}</p>
          <p><strong>نویسنده: </strong>{{ $author[0]->first_name }} {{ $author[0]->last_name }}</p>
          <p><strong>توضیحات: </strong>{{ $book->description }}</p>
          <p><strong>تعداد صفحات: </strong>{{ $book->pages }}</p>
          <?php

          //use \App\Models\Publisher;

          //$publisher = Publisher::find($book->publisher_id);
          ?>
          <p><strong>ناشر: </strong>{{ $publisher->name ?? 'ERROR: Unknown publisher' }}</p>
          <p><strong>سال انتشار: </strong>{{ date('Y', strtotime($book->year_of_publication)) }}
        </div>

        <hr style="opacity: 0.25; margin: 20px;">

        <div class="user-profile">
          <img src="{{ asset('storage/images/profile-pic.png') }}" alt="user-profile">
          <div>
            <p>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
            <small>{{ Auth::user()->name }}@</small>
          </div>
        </div>

        <div class="post-input-container">

          <form action="{{ route('book.rate', ['id' => $book->id]) }}" method="post">
            @csrf

            <select name="rating">
              @for ($i = 1; $i <= 5; $i++) <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>

            <span>
              <label style="margin-right: 15px; font-size: 15px;">
                <input type="checkbox" id="statusCheckbox">
                موردعلاقه
              </label>
              <input type="hidden" name="status_checkbox_value" id="statusCheckboxValue" value="0">
            </span>

            <textarea name="description" id="description" rows="3" placeholder="نظر خود را بنویسید..."></textarea>
            <button type="submit" class="post-status-btn">ارسال</button>
          </form>
        </div>

      </div>

      <!-- COMMENTS -->

      <!-- just like status -->
      @foreach ($ratings as $rating)
      <div class="post-container">
        <div class="user-profile">
          <a href="{{ route('user', ['id' => $rating->user_id]) }}">
            <img src="{{ asset('storage/images/profile-pic.png') }}" alt="user-profile">
          </a>
          <div>
            <a href="{{ route('user', ['id' => $rating->user_id]) }}" style="text-decoration: none; color: #626262;">
              <p>{{ $rating->first_name ?? 'Unknown first name' }} {{ $rating->last_name ?? 'Unknown last name' }}</p>
              <p></p>
              <small>{{ $rating->name ?? 'Unknown username' }}@</small>
            </a>
            <br>
            <span>{{ $rating->created_at }}</span>
          </div>
        </div>

        @if (isset($rating->comment))
        <p class="post-text">{{ $rating->comment }}</p>
        @endif
        
        
        @if (Auth::user()->id == $rating->user_id)
        <hr style="opacity: 0.25;">
        <div class="post-row">
          <div class="activity-icons">
            <div>
              <form action="{{ route('book.destroy.rating', ['id' => $rating->id]) }}" method="post">
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

    <div class="left-sidebar"></div>
  </div>

  @include('partials._footer')

  <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>