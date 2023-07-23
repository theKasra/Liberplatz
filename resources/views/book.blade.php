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

    <div class="right-sidebar">
      <div class="imp-links">
      </div>
    </div>


    <div class="main-content">

      <div class="write-post-container">

        <div class="book-container">
          <img src="{{ asset('storage/images/hamlet.jpg') }}" alt="book-img">
        </div>

        <h2>{{ $book->title }}</h2>

        <div class="book-details">
          <p><strong>شابک: </strong>{{ $book->isbn }}</p>
          <p><strong>نویسنده: </strong>{{ $book->authors[0]->first_name }} {{ $book->authors[0]->last_name }}</p>
          <p><strong>توضیحات: </strong>{{ $book->description }}</p>
          <p><strong>تعداد صفحات: </strong>{{ $book->pages }}</p>
          <?php
            use \App\Models\Publisher;
            $publisher = Publisher::find($book->publisher_id);
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

          <form action="{{ route('create.status') }}" method="post">
            @csrf

            <span>
              <input type="hidden" name="status_checkbox_value" id="statusCheckboxValue" value="0">
            </span>

            <textarea name="description" id="description" rows="3" placeholder="نظر خود را بنویسید..."></textarea>
            <button type="submit" class="post-status-btn">ارسال</button>
          </form>
        </div>

      </div>

      <!-- COMMENTS -->

      <!-- just like status -->

    </div>

    <div class="left-sidebar"></div>
  </div>

  @include('partials._footer')

  <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>