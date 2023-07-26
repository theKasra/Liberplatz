<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ناشرها</title>
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
          <div>
            <h2>ناشرها</h2>
          </div>
        </div>
      </div>

      <!-- BOOKS -->
      @foreach ($publishers as $publisher)
      <div class="post-container">
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); grid-gap: 20px;">
          <a href="{{ route('publisher', ['id' => $publisher->id]) }}">
            <div style="border: 1px solid #ccc; padding: 10px; text-align: center;">
              <img style="max-width: 100%; max-height: 150px; object-fit: cover;" src="{{ asset('storage/images/book.jpg') }}" alt="{{ $publisher->name }}">
              <h3>{{ $publisher->name }}</h3>
            </div>
          </a>
        </div>
      </div>
      @endforeach
    </div>

    <div class="left-sidebar"></div>
  </div>

  @include('partials._footer')

  <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>