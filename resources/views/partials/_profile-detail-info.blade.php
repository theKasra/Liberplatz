<div class="profile-details">
  <div class="profile-detail-right">
    <div class="profile-detail-row">
      <img class="profile-detail-image" src="{{ asset('storage/images/profile-pic.png') }}" alt="user-profile">
      <div>
        <h3> {{ $user->first_name }} {{ $user->last_name }}</h3>
        <h5 style="margin-right: 10px;"> {{ $user->name }}@</h5>
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
      <ul style="margin-right: 50px; margin-top: 5px;">
        <li>
          <a href="{{ route('user.favorites', ['id' => $user->id]) }}" style="text-decoration: none;">
            کتاب های موردعلاقه
          </a>
        </li>
        <li>
          <a href="{{ route('user.comments', ['id' => $user->id]) }}" style="text-decoration: none;">
            دیدگاه ها
          </a>
        </li>
        <li>
          <a href="{{ route('user.quotes', ['id' => $user->id]) }}" style="text-decoration: none;">
            بریده ها
          </a>
        </li>
      </ul>
      <hr>
    </div>
  </div>