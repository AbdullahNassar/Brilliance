<div class="br-logo"><a href="{{route('dashboard')}}"><span>Maikros</span></a></div>
<div class="br-sideleft overflow-y-auto">
    <label class="sidebar-label pd-x-15 mg-t-20">Navigation</label>
    <div class="br-sideleft-menu">
        <a href="{{route('dashboard')}}" class="br-menu-link @if(Route::currentRouteName()=='dashboard' || Route::currentRouteName()=='welcome') active @endif">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
                <span class="menu-item-label">Dashboard</span>
            </div>
            <!-- menu-item -->
        </a>
        <!-- br-menu-link -->
        <a href="{{route('admin.marketing.leads')}}" class="br-menu-link @if(Route::currentRouteName()=='marketing.leads.assigned' || Route::currentRouteName()=='marketing.leads.unassigned' || Route::currentRouteName()=='marketing.leads.upload' || Route::currentRouteName()=='admin.marketing.leads' || Route::currentRouteName()=='admin.marketing.campaigns' || Route::currentRouteName()=='marketing.leads.add' || Route::currentRouteName()=='marketing.campaigns.add') active show-sub @endif">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-pie-outline tx-20"></i>
                <span class="menu-item-label">Marketing</span>
            </div>
            <!-- menu-item -->
        </a>
        <ul class="br-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('admin.marketing.leads')}}" class="nav-link @if(Route::currentRouteName()=='marketing.leads.assigned' || Route::currentRouteName()=='marketing.leads.unassigned' || Route::currentRouteName()=='marketing.leads.upload' || Route::currentRouteName()=='admin.marketing.leads' || Route::currentRouteName()=='marketing.leads.add') active @endif">Leads</a></li>
          <!--<li class="nav-item"><a href="{{route('admin.marketing.campaigns')}}" class="nav-link @if(Route::currentRouteName()=='admin.marketing.campaigns' || Route::currentRouteName()=='marketing.campaigns.add') active @endif">Campaigns</a></li>-->
        </ul>
        <a href="{{route('admin.sales.leads')}}" class="br-menu-link @if(Route::currentRouteName()=='admin.tickets' || Route::currentRouteName()=='tickets.pending' || Route::currentRouteName()=='tickets.approved' || Route::currentRouteName()=='tickets.rejected' || Route::currentRouteName()=='tickets.add' || Route::currentRouteName()=='sales.leads.follow' || Route::currentRouteName()=='sales.leads.potential' || Route::currentRouteName()=='sales.leads.hold' || Route::currentRouteName()=='sales.leads.noAnswer' || Route::currentRouteName()=='sales.leads.interested' || Route::currentRouteName()=='sales.leads.outOfReach' || Route::currentRouteName()=='sales.leads.closed' || Route::currentRouteName()=='sales.tickets.add' || Route::currentRouteName()=='lead.profile' || Route::currentRouteName()=='sales.activity.add' || Route::currentRouteName()=='sales.activity.insert' || Route::currentRouteName()=='admin.sales.advisor.leads' || Route::currentRouteName()=='sales.leads.assigned' || Route::currentRouteName()=='sales.leads.unassigned' || Route::currentRouteName()=='sales.leads.upload' || Route::currentRouteName()=='admin.sales.manager.leads' || Route::currentRouteName()=='admin.sales.campaigns' || Route::currentRouteName()=='sales.leads.add' || Route::currentRouteName()=='sales.campaigns.add' || Route::currentRouteName()=='sales.manager.follow' || Route::currentRouteName()=='sales.manager.potential' || Route::currentRouteName()=='sales.manager.hold' || Route::currentRouteName()=='sales.manager.noAnswer' || Route::currentRouteName()=='sales.manager.interested' || Route::currentRouteName()=='sales.manager.outOfReach' || Route::currentRouteName()=='sales.manager.closed') active show-sub @endif">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-photos-outline tx-20"></i>
                <span class="menu-item-label">Advisors</span>
            </div>
            <!-- menu-item -->
        </a>
        <ul class="br-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('admin.sales.manager.leads')}}" class="nav-link @if(Route::currentRouteName()=='sales.leads.assigned' || Route::currentRouteName()=='sales.leads.unassigned' || Route::currentRouteName()=='sales.leads.upload' || Route::currentRouteName()=='admin.sales.manager.leads' || Route::currentRouteName()=='sales.leads.add') active @endif">Manager Leads</a></li>
          <li class="nav-item"><a href="{{route('admin.sales.advisor.leads')}}" class="nav-link @if(Route::currentRouteName()=='sales.activity.add' || Route::currentRouteName()=='admin.sales.advisor.leads' || Route::currentRouteName()=='advisor.leads.add') active @endif">Advisor Leads</a></li>
          <li class="nav-item"><a href="{{route('admin.tickets')}}" class="nav-link @if(Route::currentRouteName()=='admin.tickets' || Route::currentRouteName()=='tickets.add' || Route::currentRouteName()=='tickets.approved' || Route::currentRouteName()=='tickets.rejected' || Route::currentRouteName()=='tickets.pending') active @endif">Advisor Tickets</a></li>
        </ul>
        <a href="{{route('admin.users')}}" class="br-menu-link">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-gear-outline tx-24"></i>
                <span class="menu-item-label">Academy</span>
            </div>
            <!-- menu-item -->
        </a>
        <ul class="br-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('admin.programs')}}" class="nav-link @if(Route::currentRouteName()=='programs.published' || Route::currentRouteName()=='programs.unpublished' || Route::currentRouteName()=='programs.draft' || Route::currentRouteName()=='admin.programs' || Route::currentRouteName()=='programs.add') active @endif">Programs</a></li>
          <li class="nav-item"><a href="{{route('admin.programs')}}" class="nav-link @if(Route::currentRouteName()=='admin.categories' || Route::currentRouteName()=='categories.add') active @endif">Categories</a></li>
          <li class="nav-item"><a href="{{route('admin.programs')}}" class="nav-link @if(Route::currentRouteName()=='admin.subcategories' || Route::currentRouteName()=='subcategories.add') active @endif">Sub Categories</a></li>
          <li class="nav-item"><a href="{{route('admin.programs')}}" class="nav-link @if(Route::currentRouteName()=='program.reports') active @endif">Reports</a></li>
        </ul>
        <a href="{{route('admin.users')}}" class="br-menu-link">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-briefcase-outline tx-22"></i>
                <span class="menu-item-label">Corporate</span>
            </div>
            <!-- menu-item -->
        </a>
        <ul class="br-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('admin.users')}}" class="nav-link @if(Route::currentRouteName()=='articles.published' || Route::currentRouteName()=='articles.unpublished' || Route::currentRouteName()=='articles.draft' || Route::currentRouteName()=='articles.reported' || Route::currentRouteName()=='articles.add' || Route::currentRouteName()=='admin.articles') active @endif">Articles</a></li>
        </ul>
        <!--<a href="{{route('admin.users')}}" class="br-menu-link @if(Route::currentRouteName()=='speaks') active @endif">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
                <span class="menu-item-label">Master Module</span>
            </div>
        </a>
        <ul class="br-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('admin.users')}}" class="nav-link @if(Route::currentRouteName()=='articles.published' || Route::currentRouteName()=='articles.unpublished' || Route::currentRouteName()=='articles.draft' || Route::currentRouteName()=='articles.reported' || Route::currentRouteName()=='articles.add' || Route::currentRouteName()=='admin.articles') active @endif">Programs</a></li>
          <li class="nav-item"><a href="{{route('admin.users')}}" class="nav-link @if(Route::currentRouteName()=='admin.users') active @endif">Intakes</a></li>
          <li class="nav-item"><a href="{{route('admin.users')}}" class="nav-link @if(Route::currentRouteName()=='admin.users') active @endif">Branches</a></li>
          <li class="nav-item"><a href="{{route('admin.users')}}" class="nav-link @if(Route::currentRouteName()=='admin.users') active @endif">Diploms</a></li>
          <li class="nav-item"><a href="{{route('admin.users')}}" class="nav-link @if(Route::currentRouteName()=='admin.users') active @endif">Contacts</a></li>
          
        </ul>-->
        <a href="#" class="br-menu-link @if(Route::currentRouteName()=='admin.programs' || Route::currentRouteName()=='programs.add' || Route::currentRouteName()=='programs.edit' || Route::currentRouteName()=='admin.universities' || Route::currentRouteName()=='universities.add' || Route::currentRouteName()=='universities.edit' || Route::currentRouteName()=='admin.program.courses' || Route::currentRouteName()=='program.courses.add' || Route::currentRouteName()=='program.courses.edit' || Route::currentRouteName()=='admin.program.intakes' || Route::currentRouteName()=='program.intakes.add' || Route::currentRouteName()=='program.intakes.edit' || Route::currentRouteName()=='admin.diploms' || Route::currentRouteName()=='diploms.add' || Route::currentRouteName()=='diploms.edit' || Route::currentRouteName()=='admin.diplom.courses' || Route::currentRouteName()=='diplom.courses.add' || Route::currentRouteName()=='diplom.courses.edit' || Route::currentRouteName()=='admin.diplom.intakes' || Route::currentRouteName()=='diplom.intakes.add' || Route::currentRouteName()=='diplom.intakes.edit') active show-sub @endif">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-book-outline tx-22"></i>
                <span class="menu-item-label">Master Module</span>
            </div>
            <!-- menu-item -->
        </a>
        <ul class="br-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('admin.universities')}}" class="nav-linkks @if(Route::currentRouteName()=='admin.universities' || Route::currentRouteName()=='universities.add' || Route::currentRouteName()=='universities.edit') active @endif">-  Universities</a></li>
          <li class="nav-item">
            <a href="{{route('admin.programs')}}" class="br-menu-link-sub @if(Route::currentRouteName()=='admin.programs' || Route::currentRouteName()=='programs.add' || Route::currentRouteName()=='programs.edit' || Route::currentRouteName()=='admin.program.courses' || Route::currentRouteName()=='program.courses.add' || Route::currentRouteName()=='program.courses.edit' || Route::currentRouteName()=='admin.program.intakes' || Route::currentRouteName()=='program.intakes.add' || Route::currentRouteName()=='program.intakes.edit') active show-sub-sub @endif">
                <div class="br-menu-item-sub">
                    <i class="menu-item-icon icon ion-ios-list-outline tx-22"></i>
                    <span class="menu-item-label-sub">Programs</span>
                </div>
                <!-- menu-item -->
            </a>
            <ul class="br-menu-sub-sub nav flex-column">
                <li class="nav-item-sub"><a href="{{route('admin.programs')}}" class="nav-linkk @if(Route::currentRouteName()=='admin.programs' || Route::currentRouteName()=='programs.add' || Route::currentRouteName()=='programs.edit') active @endif">-  Programs</a></li>
                <li class="nav-item-sub"><a href="{{route('admin.program.intakes')}}" class="nav-linkk @if(Route::currentRouteName()=='admin.program.intakes' || Route::currentRouteName()=='program.intakes.add' || Route::currentRouteName()=='program.intakes.edit') active @endif">-  Intakes</a></li>
                <li class="nav-item-sub"><a href="{{route('admin.program.courses')}}" class="nav-linkk @if(Route::currentRouteName()=='admin.program.courses' || Route::currentRouteName()=='program.courses.add' || Route::currentRouteName()=='program.courses.edit') active @endif">-  Courses</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{route('admin.diploms')}}" class="br-menu-link-sub @if(Route::currentRouteName()=='admin.diploms' || Route::currentRouteName()=='diploms.add' || Route::currentRouteName()=='diploms.edit' || Route::currentRouteName()=='admin.diplom.courses' || Route::currentRouteName()=='diplom.courses.add' || Route::currentRouteName()=='diplom.courses.edit' || Route::currentRouteName()=='admin.diplom.intakes' || Route::currentRouteName()=='diplom.intakes.add' || Route::currentRouteName()=='diplom.intakes.edit') active show-sub-sub @endif">
                <div class="br-menu-item-sub">
                    <i class="menu-item-icon icon ion-ios-list-outline tx-22"></i>
                    <span class="menu-item-label-sub">Diploms</span>
                </div>
                <!-- menu-item -->
            </a>
            <ul class="br-menu-sub-sub nav flex-column">
                <li class="nav-item-sub"><a href="{{route('admin.diploms')}}" class="nav-linkk @if(Route::currentRouteName()=='admin.diploms' || Route::currentRouteName()=='diploms.add' || Route::currentRouteName()=='diploms.edit') active @endif">-  Diploms</a></li>
                <li class="nav-item-sub"><a href="{{route('admin.diplom.intakes')}}" class="nav-linkk @if(Route::currentRouteName()=='admin.diplom.intakes' || Route::currentRouteName()=='diplom.intakes.add' || Route::currentRouteName()=='diplom.intakes.edit') active @endif">-  Intakes</a></li>
                <li class="nav-item-sub"><a href="{{route('admin.diplom.courses')}}" class="nav-linkk @if(Route::currentRouteName()=='admin.diplom.courses' || Route::currentRouteName()=='diplom.courses.add' || Route::currentRouteName()=='diplom.courses.edit') active @endif">-  Courses</a></li>
            </ul>
          </li>
        </ul>
        <a href="{{route('admin.students')}}" class="br-menu-link @if(Route::currentRouteName()=='admin.students' || Route::currentRouteName()=='students.profile' || Route::currentRouteName()=='students.add' || Route::currentRouteName()=='students.edit') active @endif">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-20"></i>
                <span class="menu-item-label">Students</span>
            </div>
            <!-- menu-item -->
        </a>
        <a href="{{route('admin.users')}}" class="br-menu-link @if(Route::currentRouteName()=='admin.users' || Route::currentRouteName()=='users.add' || Route::currentRouteName()=='users.edit' || Route::currentRouteName()=='users.students' || Route::currentRouteName()=='users.doctors' || Route::currentRouteName()=='users.operation' || Route::currentRouteName()=='users.sales' || Route::currentRouteName()=='users.marketing' || Route::currentRouteName()=='users.finance' || Route::currentRouteName()=='users.corporate') active @endif">
            <div class="br-menu-item">
                <i class="menu-item-icon icon ion-ios-people-outline tx-24"></i>
                <span class="menu-item-label">Users</span>
            </div>
            <!-- menu-item -->
        </a>
        <!-- br-menu-link -->
    </div>
    <!-- br-sideleft-menu -->

    <label class="sidebar-label pd-x-15 mg-t-25 mg-b-20 tx-info op-9">Information Summary</label>

    <div class="info-list">
        <div class="d-flex align-items-center justify-content-between pd-x-15">
            <div>
                <p class="tx-10 tx-roboto tx-uppercase tx-spacing-1 tx-white op-3 mg-b-2 space-nowrap">Memory Usage</p>
                <h5 class="tx-lato tx-white tx-normal mg-b-0">32.3%</h5>
            </div>
            <span class="peity-bar" data-peity='{ "fill": ["#336490"], "height": 35, "width": 60 }'>8,6,5,9,8,4,9,3,5,9</span>
        </div>

        <div class="d-flex align-items-center justify-content-between pd-x-15 mg-t-20">
            <div>
                <p class="tx-10 tx-roboto tx-uppercase tx-spacing-1 tx-white op-3 mg-b-2 space-nowrap">CPU Usage</p>
                <h5 class="tx-lato tx-white tx-normal mg-b-0">140.05</h5>
            </div>
            <span class="peity-bar" data-peity='{ "fill": ["#1C7973"], "height": 35, "width": 60 }'>4,3,5,7,12,10,4,5,11,7</span>
        </div>

        <div class="d-flex align-items-center justify-content-between pd-x-15 mg-t-20">
            <div>
                <p class="tx-10 tx-roboto tx-uppercase tx-spacing-1 tx-white op-3 mg-b-2 space-nowrap">Disk Usage</p>
                <h5 class="tx-lato tx-white tx-normal mg-b-0">82.02%</h5>
            </div>
            <span class="peity-bar" data-peity='{ "fill": ["#8E4246"], "height": 35, "width": 60 }'>1,2,1,3,2,10,4,12,7</span>
        </div>

        <div class="d-flex align-items-center justify-content-between pd-x-15 mg-t-20">
            <div>
                <p class="tx-10 tx-roboto tx-uppercase tx-spacing-1 tx-white op-3 mg-b-2 space-nowrap">Daily Traffic</p>
                <h5 class="tx-lato tx-white tx-normal mg-b-0">62,201</h5>
            </div>
            <span class="peity-bar" data-peity='{ "fill": ["#9C7846"], "height": 35, "width": 60 }'>3,12,7,9,2,3,4,5,2</span>
        </div>
    </div>

    <br>
</div>
<!-- br-sideleft -->