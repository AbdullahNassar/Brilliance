<div class="br-header">
  <div class="br-header-left">
    <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
    <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
    <div class="input-group hidden-xs-down wd-170 transition">
      <input id="searchbox" type="text" class="form-control" placeholder="Search">
      <span class="input-group-btn">
        <button class="btn btn-secondary" type="button"><i class="fa fa-search"></i></button>
      </span>
    </div>
  </div><!-- br-header-left -->
  <div class="br-header-right">
    <nav class="nav">
      <div class="dropdown">
        <a href="" class="nav-link pd-x-7 pos-relative" data-toggle="dropdown">
          <i class="icon ion-ios-email-outline tx-24"></i>
          <span class="square-8 bg-danger pos-absolute t-15 r-0 rounded-circle"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-header wd-300 pd-0-force">
          <div class="d-flex align-items-center justify-content-between pd-y-10 pd-x-20 bd-b bd-gray-200">
            <label class="tx-12 tx-info tx-uppercase tx-semibold tx-spacing-2 mg-b-0">Messages</label>
            <a href="" class="tx-11">+ Add New Message</a>
          </div>

          <div class="media-list">
            <a href="" class="media-list-link">
              <div class="media pd-x-20 pd-y-15">
                <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
                <div class="media-body">
                  <div class="d-flex align-items-center justify-content-between mg-b-5">
                    <p class="mg-b-0 tx-medium tx-gray-800 tx-14">Donna Seay</p>
                    <span class="tx-11 tx-gray-500">2 minutes ago</span>
                  </div>
                  <p class="tx-12 mg-b-0">A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring.</p>
                </div>
              </div>
            </a>
            <a href="" class="media-list-link read">
              <div class="media pd-x-20 pd-y-15">
                <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
                <div class="media-body">
                  <div class="d-flex align-items-center justify-content-between mg-b-5">
                    <p class="mg-b-0 tx-medium tx-gray-800 tx-14">Samantha Francis</p>
                    <span class="tx-11 tx-gray-500">3 hours ago</span>
                  </div>
                  <p class="tx-12 mg-b-0">My entire soul, like these sweet mornings of spring.</p>
                </div>
              </div>
            </a>
            <a href="" class="media-list-link read">
              <div class="media pd-x-20 pd-y-15">
                <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
                <div class="media-body">
                  <div class="d-flex align-items-center justify-content-between mg-b-5">
                    <p class="mg-b-0 tx-medium tx-gray-800 tx-14">Robert Walker</p>
                    <span class="tx-11 tx-gray-500">5 hours ago</span>
                  </div>
                  <p class="tx-12 mg-b-0">I should be incapable of drawing a single stroke at the present moment...</p>
                </div>
              </div>
            </a>
            <a href="" class="media-list-link read">
              <div class="media pd-x-20 pd-y-15">
                <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
                <div class="media-body">
                  <div class="d-flex align-items-center justify-content-between mg-b-5">
                    <p class="mg-b-0 tx-medium tx-gray-800 tx-14">Larry Smith</p>
                    <span class="tx-11 tx-gray-500">Yesterday</span>
                  </div>
                  <p class="tx-12 mg-b-0">When, while the lovely valley teems with vapour around me, and the meridian sun strikes...</p>
                </div>
              </div>
            </a>
            <div class="pd-y-10 tx-center bd-t">
              <a href="" class="tx-12"><i class="fa fa-angle-down mg-r-5"></i> Show All Messages</a>
            </div>
          </div>
        </div>
      </div>
      <div class="dropdown">
        <a href="" class="nav-link pd-x-7 pos-relative" data-toggle="dropdown">
          <i class="icon ion-ios-bell-outline tx-24"></i>
          @if(count(Auth::user()->unreadNotifications))
          <span class="square-8 bg-danger pos-absolute t-15 r-5 rounded-circle"></span>
          @endif
        </a>
        <div class="dropdown-menu dropdown-menu-header wd-300 pd-0-force">
          <div class="d-flex align-items-center justify-content-between pd-y-10 pd-x-20 bd-b bd-gray-200">
            <label class="tx-12 tx-info tx-uppercase tx-semibold tx-spacing-2 mg-b-0">Notifications</label>
            <a href="{{route('markAsRead')}}" class="tx-11">Mark All as Read</a>
          </div>
          <div class="media-list">
            @foreach(Auth::user()->unreadNotifications as $notification)
            <a href="" class="media-list-link read">
              <div class="media pd-x-20 pd-y-15">
                <img src="{{asset('images/users').'/'.Auth::user()->image}}" class="wd-40 rounded-circle" alt="">
                <div class="media-body">
                  <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">{{Auth::user()->name}}</strong>  @include('admin.layouts.partials.notifications.'.snake_case(class_basename($notification->type)))</p>
                  <span class="tx-12">{{(new DateTime($notification->created_at))->format('M')}} {{(new DateTime($notification->created_at))->format('j')}}, {{(new DateTime($notification->created_at))->format('Y')}} {{(new DateTime($notification->created_at))->format('h:i:a')}}</span>
                </div>
              </div>
            </a>
            @endforeach
            @foreach(Auth::user()->readNotifications as $notification)
            <a href="" class="media-list-link">
              <div class="media pd-x-20 pd-y-15">
                <img src="{{asset('images/users').'/'.Auth::user()->image}}" class="wd-40 rounded-circle" alt="">
                <div class="media-body">
                  <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">{{Auth::user()->name}}</strong>  @include('admin.layouts.partials.notifications.'.snake_case(class_basename($notification->type)))</p>
                  <span class="tx-12">{{(new DateTime($notification->created_at))->format('M')}} {{(new DateTime($notification->created_at))->format('j')}}, {{(new DateTime($notification->created_at))->format('Y')}} {{(new DateTime($notification->created_at))->format('h:i:a')}}</span>
                </div>
              </div>
            </a>
            @endforeach
            <div class="pd-y-10 tx-center bd-t">
              <a href="" class="tx-12"><i class="fa fa-angle-down mg-r-5"></i> Show All Notifications</a>
            </div>
          </div>
        </div>
      </div>
      <div class="dropdown">
        <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
          <span class="logged-name hidden-md-down">{{Auth::user()->name}}</span>
          <img src="{{asset('images/users/'.Auth::user()->image)}}" class="wd-32 rounded-circle" alt="">
          <!--<img src="{{asset('images/users').'/'.Auth::user()->image}}" class="wd-32 rounded-circle" alt="">-->
          <span class="square-10 bg-success"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-header wd-200">
          <ul class="list-unstyled user-profile-nav">
            <li><a href="{{route('admin.profile')}}"><i class="icon ion-ios-person"></i> Edit Profile</a></li>
            <li><a href="{{route('logout')}}" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();"><i class="icon ion-power"></i> Sign Out</a></li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </ul>
        </div><!-- dropdown-menu -->
      </div><!-- dropdown -->
    </nav>
    <div class="navicon-right">
      <a id="btnRightMenu" href="" class="pos-relative">
        <i class="icon ion-ios-chatboxes-outline"></i>
        <!-- start: if statement -->
        <span class="square-8 bg-danger pos-absolute t-10 r--5 rounded-circle"></span>
        <!-- end: if statement -->
      </a>
    </div><!-- navicon-right -->
  </div><!-- br-header-right -->
</div><!-- br-header -->