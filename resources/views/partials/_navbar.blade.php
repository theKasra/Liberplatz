<nav>
    <div class="nav-right">
      <a href="/home">
        <img src="{{ asset('storage/images/logo.png') }}" alt="logo" class="logo">
      </a>

      <div class="nav-user-icon">
        <img src="{{ asset('storage/images/profile-pic.png') }}" alt="user-img">
      </div>

      <ul>
        <li><img src="{{ asset('storage/images/books.png') }}" alt="books-img"></li>
        <li><img src="{{ asset('storage/images/people.png') }}" alt="people-img"></li>
        <li>
        <a class="nav-link" href="{{ route('logout') }}"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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