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
              <h2>کتاب های موردعلاقه</h2>
            </div>
          </div>
        </div>

        <!-- FAVORITES -->

        @foreach ($favorite_books as $favorite)
          <div class="post-container">
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); grid-gap: 20px;">
              <a href="{{ route('book', ['id' => $favorite->id]) }}">
                <div style="border: 1px solid #ccc; padding: 10px; text-align: center;">
                  <img style="max-width: 100%; max-height: 150px; object-fit: cover;" src="{{ asset('storage/images/book.jpg') }}" alt="{{ $favorite->title }}">
                  <h3>{{ $favorite->title }}</h3>
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