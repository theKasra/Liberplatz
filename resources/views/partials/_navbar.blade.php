<nav>
  <div class="nav-right">
    <a href="{{ route('home') }}">
      <img src="{{ asset('storage/images/logo.png') }}" alt="logo" class="logo">
    </a>

    <div class="nav-user-icon">
      <a href="{{ route('user', ['id' => Auth::user()->id]) }}">
        <img src="{{ asset('storage/images/profile-pic.png') }}" alt="user-img">
      </a>
    </div>

    <ul>
      <a style="text-decoration: none;" href="{{ route('user.favorites', ['id' => Auth::user()->id]) }}">
        <li><img src="{{ asset('storage/images/books.png') }}" alt="books-img"></li>
      </a>
      <a style="text-decoration: none;" href="{{ route('user.followers', ['id' => Auth::user()->id]) }}">
        <li><img src="{{ asset('storage/images/people.png') }}" alt="people-img"></li>
      </a>
      <li>
        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <img src="{{ asset('storage/images/logout.png') }}" alt="logout-img">
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </li>
    </ul>
  </div>

  <div class="nav-left">
    <div class="search-box">
      <img src="{{ asset('storage/images/search.png') }}" alt="search-img">
      <input type="text" placeholder="جستجو">
    </div>
  </div>
</nav>