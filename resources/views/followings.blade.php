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

    <div class="profile-details">
      <div class="profile-detail-right">
        <div class="profile-detail-row">
          <img class="profile-detail-image" src="{{ asset('storage/images/profile-pic.png') }}" alt="user-profile">
          <div>
            <h3> {{ $user->first_name }} {{ $user->last_name }}</h3>
            <h5 style="margin-right: 10px;"> {{ $user->name }}@</h5>
            <!-- <p>دنبال کنندگان</p>
                    <p>دنبال شوندگان</p> -->
            <a href="{{ route('user.followings', ['id' => $user->id ]) }}">دنبال کنندگان: {{ $following_count }}</a>
            <a href="{{ route('user.followers', ['id' => $user->id ]) }}">دنبال شوندگان: {{ $follower_count }}</a>
          </div>
        </div>
      </div>

      @if ($user->id != Auth::user()->id)
        @if (!Auth::user()->isFollowing($user))
          <div class="profile-detail-left">
            <form action="{{ route('user.follow', ['id' => $user->id]) }}" method="post">
              @csrf
              <button type="submit">دنبال کن<img src="{{ asset('storage/images/follow.png') }}" alt=""></button>
            </form>
          </div>

          @else
          <div class="profile-detail-left">
            <form action="{{ route('user.unfollow', ['id' => $user->id]) }}" method="post">
              @csrf
              <button type="submit" style="background: #e4e6eb; color: black;">دنبال نکن<img src="{{ asset('storage/images/follow.png') }}" alt=""></button>
            </form>
          </div>
        @endif

      @endif
    </div>

    <div class="profile-info">


      <div class="info-column">
        <div>
          @include('partials._right-side-bar')
        </div>
        <div class="profile-intro">
          <h3 style="margin-right: 30px; margin-bottom: 12px;">لیست های شخصی</h3>
          <!-- <p class="intro-text">سلام. این یک تست است.</p> -->
          <ul style="margin-right: 50px; margin-top: 5px;">
            <li>
              <a href="" style="text-decoration: none;">
                کتاب های موردعلاقه
              </a>
            </li>
            <li>
              <a href="" style="text-decoration: none;">
                دیدگاه ها
              </a>
            </li>
            <li>
              <a href="" style="text-decoration: none;">
                بریده ها
              </a>
            </li>
          </ul>
          <hr>
        </div>
      </div>

      <div class="post-column">

        <div class="write-post-container">
          <div class="user-profile">
            <div>
              <h2>دنبال کنندگان</h2>
            </div>
          </div>
        </div>

        <!-- FOLLOWINGS -->

        @foreach ($followings as $following)
          <div class="post-container">
            <a style="text-decoration: none;" href="{{ route('user', ['id' => $following->id]) }}">
              {{ $following->first_name }} {{ $following->last_name }}
              <small>{{ $following->name }}@</small>
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