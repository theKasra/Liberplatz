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

        @if (Auth::user()->id == $user->id)
        <div class="write-post-container">
          <div class="user-profile">
            <img src="{{ asset('storage/images/profile-pic.png') }}" alt="user-profile">
            <div>
              <p>{{ $user->first_name }} {{ $user->last_name }}</p>
              <small>{{ $user->name }}@</small>
            </div>
          </div>

          <div class="post-input-container">

            <form action="{{ route('status.store') }}" method="post">
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
        @endif

        <!-- STATUSES -->

        @foreach ($statuses as $status)
          <div class="post-container">
            <div class="user-profile">
              <img src="{{ asset('storage/images/profile-pic.png') }}" alt="user-profile">
              <div>
                <p>{{ $user->first_name ?? 'Unknown first name' }} {{ $user->last_name ?? 'Unknown last name' }}</p>
                <p></p>
                <small>{{ $user->name ?? 'Unknown username' }}@</small>
                <br>
                <span>{{ $status->created_at }}</span>
                </div>
              </div>

              @if (isset($status->description))
                <p class="post-text">{{ $status->description }}</p>
                <hr style="opacity: 0.25;">
                <a href="{{ route('book', ['id' => $status->book_id]) }}" style="text-decoration: none; color: #626262;">
                  <p style="font-size: 13px; padding: 5px; text-align: left;">{{ $status->book_title }}</p>
                </a>
                @if ($status->status == true)
                  <p style="font-size: 13px; padding: 5px; text-align: left;">خوانده شد</p>
                @else
                  <p style="font-size: 13px; padding: 5px; text-align: left;">خوانده نشد</p>
                @endif
              @else
                @if ($status->status == 0)
                  <p class="post-text">کتاب {{ $status->book_title }} را نخوانده ام</p>
                @else
                  <p class="post-text">کتاب {{ $status->book_title }} را خوانده ام</p>
                @endif
              @endif

            @if (Auth::user()->id == $status->user_id)
            <div class="post-row">
              <div class="activity-icons">
                <div>
                  <form action="{{ route('status.destroy', ['id' => $status->id]) }}" method="post">
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
    </div>

  </div>
  </div>

  @include('partials._footer')

  <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>