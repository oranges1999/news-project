<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">NEWS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        @if (!Auth::check())
        <li class="nav-item dropdown d-flex align-items-center">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Login
          </a>
          <div class="dropdown-menu">
            <form class="px-4 py-3" method="post" action="{{route('pLogin')}}">
              @csrf
              <div class="form-group">
                <label for="exampleDropdownFormEmail1">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleDropdownFormEmail1" placeholder="email@example.com">
              </div>
              <div class="form-group">
                <label for="exampleDropdownFormPassword1">Password</label>
                <input type="password" name="password" class="form-control" id="exampleDropdownFormPassword1" placeholder="Password">
              </div>
              <button type="submit" class="btn btn-primary">Sign in</button>
            </form>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{route('register')}}">New around here? Sign up</a>
          </div>
        </li>
        @else
        <li class="nav-item dropdown d-flex align-items-center">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Hello <i>{{Auth::user()->name}}</i>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Information</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{route('logout')}}">Log out</a></li>
            @can('only-admin-writer',Auth::user())
            <li><a class="dropdown-item" href="{{route('admin.homepage')}}">Admin section</a></li>  
            @endcan
          </ul>
        </li>
        @endif
        <li class="nav-item d-flex align-items-center">
          <a class="nav-link" aria-current="page" href="{{route('homepage')}}">Home</a>
        </li>
        <div class="vr"></div>
        @foreach ($categories as $category)
        <li class="nav-item d-flex align-items-center">
          <a class="nav-link" href="{{route('postCategory',$category->id)}}">{{$category->category}}</a>
        </li>
        @endforeach
      </ul>
      <div class="vr"></div>
      <div>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item d-flex align-items-center">
            <a class="nav-link" data-widget="fullscreen" href="{{route('postFilter')}}" role="button">
              Advance Search
            </a>  
          </li>
          <div class="vr"></div>
          <div class="btn-group">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
              <i class="fa-regular fa-bell"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              @auth()
                @foreach (Auth::user()->unreadNotifications as $notification)
                <li class="nav-item d-flex justify-content-between">
                  <div class="">
                    <div><strong>{{$notification->data['title']}}</strong></div>
                    <div><i>{{$notification->data['msg']}}</i></div>
                  </div>
                </li>
                <li><hr class="dropdown-divider"></li>
                @endforeach
                <li class="nav-item d-flex justify-content-center">
                  <a href="{{route('markAllRead')}}">Mark all as read</a>
                </li>
              @else
              <li class="nav-item d-flex justify-content-center">
                <p>Login to see notifications</p>
              </li>
              @endauth
            </ul>
          </div>
        </ul>
      </div>
    </div>
  </div>
</nav>