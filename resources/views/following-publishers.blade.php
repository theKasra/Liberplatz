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
              <h2>ناشرهای دنبال شده</h2>
            </div>
          </div>
        </div>

        <!-- FOLLOWING PUBLISHERS -->

        @foreach ($following_publishers as $publisher)
          <div class="post-container">
            <a style="text-decoration: none;" href="{{ route('publisher', ['id' => $publisher->id]) }}">
              نشر {{ $publisher->name }}
            </a>
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