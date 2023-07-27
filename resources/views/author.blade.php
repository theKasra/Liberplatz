<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@ {{ $author->first_name }} - {{ $author->last_name }}</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://cdn.fontcdn.ir/Font/Persian/Vazir/v5.0.2/Vazir.css" type="text/css">
</head>

<body>

  @include('partials._navbar')

  <div class="profile-container">

    <div class="profile-details">
      <div class="profile-detail-right">
        <div class="profile-detail-row">
          <img class="profile-detail-image" src="{{ asset('storage/images/profile-pic.png') }}" alt="pub-profile">
          <div>
            <h3>{{ $author->first_name }} {{ $author->last_name }}</h3>
          </div>
        </div>
      </div>

    </div>

    <div class="profile-info">

    <div class="info-column">
      <div>
        @include('partials._right-side-bar')
      </div>
      <div class="profile-intro">
        <h3 style="margin-right: 30px; margin-bottom: 12px;">زندگی نامه</h3>
        <p style="margin-right: 30px; margin-top: 5px; font-size: 15px;">{{ $author->biography }}</p>
        <hr>
      </div>
    </div>

    <div class="post-column">

      <div class="write-post-container">
        <div class="user-profile">
          <div>
            <h2>کتاب ها</h2>
          </div>
        </div>
      </div>

      <!-- AUTHOR'S BOOKS -->

      @foreach ($books as $book)
      <div class="post-container">
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); grid-gap: 20px;">
          <a href="{{ route('book', ['id' => $book->id]) }}">
            <div style="border: 1px solid #ccc; padding: 10px; text-align: center;">
              <img style="max-width: 100%; max-height: 150px; object-fit: cover;" src="{{ asset('storage/images/book.jpg') }}" alt="{{ $book->title }}">
              <h3>{{ $book->title }}</h3>
            </div>
          </a>
        </div>
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