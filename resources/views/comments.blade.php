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
              <h2>دیدگاه ها</h2>
            </div>
          </div>
        </div>

        <!-- COMMENTS -->

        @foreach ($comments as $comment)
          <div class="post-container">

            <div class="user-profile">
            <a href="{{ route('user', ['id' => $comment->user_id]) }}">
              <img src="{{ asset('storage/images/profile-pic.png') }}" alt="user-profile">
            </a>
              <div>
                <a href="{{ route('user', ['id' => $comment->user_id]) }}" style="text-decoration: none; color: #626262;">
                  <p>{{ $user->first_name ?? 'Unknown first name' }} {{ $user->last_name ?? 'Unknown last name' }}</p>
                  <p></p>
                  <small>{{ $user->name ?? 'Unknown username' }}@</small>
                </a>
                <br>
                <span>{{ $comment->created_at }}</span>
              </div>
            </div>

            <p style="margin-top: 10px; margin-bottom: 10px;">{{ $comment->comment }}</p>
            <hr style="opacity: 0.25;">
            <a href="{{ route('book', ['id' => $comment->book_id]) }}">
              <p style="font-size: 13px; padding: 2px; text-align: left;">{{ $comment->book_title }}</p>
            </a>
            <p style="font-size: 13px; padding: 2px; text-align: left;">امتیاز {{ $comment->rating }} از 5</p>

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