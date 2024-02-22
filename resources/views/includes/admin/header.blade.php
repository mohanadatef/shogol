<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('admin.dashboard')}}" class="nav-link">{{$custom[strtolower('Home')]??"lang not found"}}</a>
        </li>
    </ul>

    <!-- SEARCH FORM -->
    {{--<form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>--}}

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-danger navbar-badge">{{$countNotification}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" >

                @foreach ( $notifications as $notification )
                <a href="{{ route('notification.read', [$notification->id]) }}" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media" style="whiteSpace:wrap;">
                        {{-- <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle"> --}}
                        <div class="media-body" >
                            <p class="dropdown-item-title" text-overflow="ellipsis" width=237px overflow="hidden"-webkit-box-orient="vertical" >
                              {{$notification->title->value ?? ""}}
                                @if(empty($notification->read_at))
                                    <span class="float-right text-sm text-blue"><i class="fas fa-circle"></i></span>
                                @endif

                            </p>
                            <p class="text-sm">{{$notification->descreption->value ?? ""}}</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> {{$notification->createdAtValue}}</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                @endforeach
                <a href="{{ route('notification.index')}}" class="dropdown-item dropdown-footer">Show All</a>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
       {{-- <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>--}}
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('logout')}}" class="nav-link">{{$custom[strtolower('logout')]??"lang not found"}}</a>
        </li>
    </ul>
</nav>
@yield('header')
