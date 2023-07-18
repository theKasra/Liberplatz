<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>خانه - SocialBook</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://cdn.fontcdn.ir/Font/Persian/Vazir/v5.0.2/Vazir.css" type="text/css">
</head>
<body>

  <nav>
    <div class="nav-right">
      <img src="{{ asset('storage/images/logo.png') }}" alt="logo" class="logo">

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

  <div class="container">
    <div class="right-sidebar">
      <div class="imp-links">
        <a href="#"><img src="images/publishers.png" alt="pubs-img"></a>
        <a href="#"><img src="images/publishers.png" alt="pubs-img"></a>
        <a href="#"><img src="images/publishers.png" alt="pubs-img"></a>
        <a href="#"><img src="images/publishers.png" alt="pubs-img"></a>
        <a href="#"><img src="images/publishers.png" alt="pubs-img"></a>
      </div>
    </div>


    <div class="main-content">
      <div class="write-post-container">
        <div class="user-profile">
          <img src="{{ asset('storage/images/profile-pic.png') }}" alt="user-profile">
          <div>
            <p>نام و نام خانوادگی</p>
            <small>@username</small>
          </div>
        </div>

        <div class="post-input-container">
          <textarea rows="3" placeholder="درباره کتاب..."></textarea>
          
          <div class="add-post-links">
          </div>
        </div>

      </div>

      <div class="post-container">
        
        <div class="user-profile">
          <img src="{{ asset('storage/images/profile-pic.png') }}" alt="user-profile">
          <div>
            <p>نام کاربری</p>
            <span>تاریخ و ساعت نوشته</span>
          </div>
        </div>

        <p class="post-text">تست می شود.</p>

        <div class="post-row">
          <div class="activity-icons">
            <div><img src="{{ asset('storage/images/comments.png') }}" alt="comments-img">دیدگاه ها</div>
          </div>

        </div>
      </div>

      <button type="button" class="load-more-btn">بارگذاری بیشتر</button>

    </div>

    <div class="left-sidebar"></div>
  </div>

  <div class="footer">
    <p>پروژه لاراول مباحث ویژه 2 - کسری صالحوند</p>
  </div>

</body>
</html>