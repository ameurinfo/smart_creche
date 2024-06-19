  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('children.index')}}" class="nav-link">الرئيسية</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">قائمة الاتصال</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="بحث..." aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav mr-auto-navbav">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">{{auth()->user()->unreadNotifications->count()}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">{{auth()->user()->unreadNotifications->count()}} إشعار</span>
          <div class="dropdown-divider"></div>
          @foreach(auth()->user()->unreadnotifications as $notification)
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 
                {{ $notification->data['type'] }}
                <span class="float-right text-muted text-sm">{{$notification->created_at->diffForHumans()}}</span>
                </a>
          @endforeach
          <div class="dropdown-divider"></div>
          <a href="{{ route('notifications.index') }}" class="dropdown-item dropdown-footer">عرض كل اﻹشعارات</a>
        </div>
      </li>
      {{-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fas fa-th-large"></i>
        </a>
      </li> --}}

<!-- User Account Menu -->
<li class="nav-item dropdown user-menu">
  <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
    <img src="{{ Auth::user()->hasRole('parents') ? (Auth::user()->parent->image ? asset('storage/' . Auth::user()->parent->image) : asset('backend/dist/img/userProfile.png')) : (Auth::user()->staff->image ? asset('storage/' . Auth::user()->staff->image) : asset('backend/dist/img/userProfile.png')) }}" class="user-image img-circle elevation-2" alt="User Image">

      <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
  </a>
  <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
      <!-- User image -->
      <li class="user-header bg-primary">
        <img src="{{ Auth::user()->hasRole('parents') ? (Auth::user()->parent->image ? asset('storage/' . Auth::user()->parent->image) : asset('backend/dist/img/userProfile.png')) : (Auth::user()->staff->image ? asset('storage/' . Auth::user()->staff->image) : asset('backend/dist/img/userProfile.png')) }}" class="img-circle elevation-2" alt="User Image">
            <p>
              {{ Auth::user()->name }}
              <small>Member since {{ Auth::user()->created_at->format('M. Y') }}</small>
          </p>
      </li>
      <!-- Menu Body -->
      <!-- Menu Footer-->
      <li class="user-footer">
          <a href="{{route('profiles.show')}}" class="btn btn-default btn-flat">Profile</a>
          <a href="{{ route('logout') }}" class="btn btn-default btn-flat float-right"
             onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              Logout
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
      </li>
  </ul>
</li>

    </ul>
  </nav>
  <!-- /.navbar -->