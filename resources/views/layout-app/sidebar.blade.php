  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{route('children.index')}}" class="brand-link">
      <img src="{{asset('backend/dist/img/logo.ico')}}" alt="SMART C Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">SMARTC</span>
    </a>
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ Auth::user()->hasRole('parents') ? (Auth::user()->parent->image ? asset('storage/' . Auth::user()->parent->image) : asset('backend/dist/img/userProfile.png')) : (Auth::user()->staff->image ? asset('storage/' . Auth::user()->staff->image) : asset('backend/dist/img/userProfile.png')) }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview {{ $active_menu === 'children.' ? 'menu-open' : '' }}">
            @can('follow_up_children')
            <a href="#" class="nav-link {{ $active_menu === 'children.' ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                متابعة اﻷطفال
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            @endcan
            <ul class="nav nav-treeview">
              @can('children_information')
              <li class="nav-item">
                <a href="{{route('children.index')}}" class="nav-link {{ $active_supmenu === 'children.index' ? 'active' : '' }}">
                  <i class="fa fa-child nav-icon"></i>
                  <p> معلومات اﻷطفال</p>
                </a>
              </li>
              @endcan
              @can('attendance')
              <li class="nav-item">
                <a href="{{route('attendance.create')}}" class="nav-link {{ $active_supmenu === 'attendance.create' ? 'active' : '' }}">
                  <i class="fa fa-list nav-icon"></i>
                  <p> الحضور والغياب</p>
                </a>
              </li>
              @endcan
              @can('departure')
              <li class="nav-item">
                <a href="{{route('attendance.departure')}}" class="nav-link {{ $active_supmenu === 'attendance.departure' ? 'active' : '' }}">
                  <i class="fas fa-door-open nav-icon"></i>
                  <p> المغادرة</p>
                </a>
              </li>
              @endcan
              @can('attendance_tracking')
              <li class="nav-item">
                <a href="{{route('attendance.tracking')}}" class="nav-link {{ $active_supmenu === 'attendance.tracking' ? 'active' : '' }}">
                  <i class="fas fa-paper-plane nav-icon"></i>
                  <p>تتبع الحضور</p>
                </a>
              </li>
              @endcan
              @can('meal_tracking')
              <li class="nav-item">
                <a href="{{route('children.createMeals')}}" class="nav-link {{ $active_supmenu === 'children.createMeals' ? 'active' : '' }}">
                  <i class="fas fa-paper-plane nav-icon"></i>
                  <p>تتبع الوجبات</p>
                </a>
              </li>
              @endcan
              @can('sleep_tracking')
              <li class="nav-item">
                <a href="{{route('children.createSleep')}}" class="nav-link {{ $active_supmenu === 'children.createSleep' ? 'active' : '' }}">
                  <i class="fas fa-paper-plane nav-icon"></i>
                  <p>تتبع النوم</p>
                </a>
              </li>
              @endcan
            </ul>
          </li>
          <li class="nav-item has-treeview {{ $active_menu === 'children' ? 'menu-open' : '' }}">
            @can('classes_activities')
            <a href="#" class="nav-link {{ $active_menu === 'children' ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                 الصفوف واﻷنشطة
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            @endcan
            <ul class="nav nav-treeview">
            @can('activities')
            <li class="nav-item">
              <a href="#" class="nav-link {{ $active_supmenu === 'attendance.departure' ? 'active' : '' }}">
                <i class="fas fa-tasks nav-icon"></i>
                <p> اﻷنشطة</p>
              </a>
            </li>
            @endcan
            @can('classes')
              <li class="nav-item">
                <a href="#" class="nav-link {{ $active_supmenu === 'children.index' ? 'active' : '' }}">
                  <i class="fa fa-university nav-icon"></i>
                  <p> الصفوف </p>
                </a>
              </li>
            @endcan
            </ul>
          </li>
          <li class="nav-item has-treeview {{ $active_menu === 'children' ? 'menu-open' : '' }}">
          @can('health_safety')
            <a href="#" class="nav-link {{ $active_menu === 'children' ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                 الصحة والسلامة
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          @endcan
            <ul class="nav nav-treeview">
            @can('health_records')
              <li class="nav-item">
                <a href="{{route('children.index')}}" class="nav-link {{ $active_supmenu === 'children.index' ? 'active' : '' }}">
                  <i class="fa fa-university nav-icon"></i>
                  <p>السجلات الصحية </p>
                </a>
              </li>
            @endcan
            @can('cumulative_record')
            <li class="nav-item">
              <a href="#" class="nav-link {{ $active_supmenu === 'attendance.departure' ? 'active' : '' }}">
                <i class="fas fa-tasks nav-icon"></i>
                <p>السجل التراكمي </p>
              </a>
            </li>
            @endcan
            @can('incident_management')
              <li class="nav-item">
                <a href="#" class="nav-link {{ $active_supmenu === 'attendance.create' ? 'active' : '' }}">
                  <i class="fa fa-book-open nav-icon"></i>
                  <p>إدارة الحوادث </p>
                </a>
              </li>
            @endcan
            @can('communicate_with_child')
              <li class="nav-item">
                <a href="{{route('video-chat')}}" class="nav-link {{ $active_supmenu === 'attendance.create' ? 'active' : '' }}">
                  <i class="fa fa-book-open nav-icon"></i>
                  <p>أتواصل مع طفلي</p>
                </a>
              </li>
            @endcan
            </ul>
          </li>
          <li class="nav-item has-treeview {{ $active_menu === 'staff' ? 'menu-open' : '' }}">
          @can('staff_management')
            <a href="#" class="nav-link {{ $active_menu === 'staff' ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                تسيير الموظفين
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          @endcan
            <ul class="nav nav-treeview">
            @can('staff_information')
              <li class="nav-item">
                <a href="{{route('staff.index')}}" class="nav-link {{ $active_supmenu === 'staff.index' ? 'active' : '' }}">
                  <i class="fa fa-university nav-icon"></i>
                  <p>معلومات الموظفين  </p>
                </a>
              </li>
            @endcan
            @can('add_staff')
            <li class="nav-item">
              <a href="#" class="nav-link {{ $active_supmenu === 'attendance.departure' ? 'active' : '' }}">
                <i class="fas fa-tasks nav-icon"></i>
                <p> إضافة موظف </p>
              </a>
            </li>
            @endcan
            @can('work_scheduling')
              <li class="nav-item">
                <a href="#" class="nav-link {{ $active_supmenu === 'attendance.create' ? 'active' : '' }}">
                  <i class="fa fa-book-open nav-icon"></i>
                  <p>جدولة العمل </p>
                </a>
              </li>
            @endcan
            @can('staff_attendance_traking')
              <li class="nav-item">
                <a href="#" class="nav-link {{ $active_supmenu === 'attendance.create' ? 'active' : '' }}">
                  <i class="fa fa-book-open nav-icon"></i>
                  <p>تتبع الحضور </p>
                </a>
              </li>
              @endcan
              @can('staff_salary_management')
              <li class="nav-item">
                <a href="#" class="nav-link {{ $active_supmenu === 'attendance.create' ? 'active' : '' }}">
                  <i class="fa fa-book-open nav-icon"></i>
                  <p>تسيير الرواتب </p>
                </a>
              </li>
              @endcan
            </ul>
          </li>
          <li class="nav-item has-treeview {{ $active_menu === 'users.' ? 'menu-open' : '' }}">
          @can('users')
            <a href="#" class="nav-link {{ $active_menu === 'users.' ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                 المستخدمين
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          @endcan
            <ul class="nav nav-treeview">
            @can('users_information')
              <li class="nav-item">
                <a href="{{route('users.index')}}" class="nav-link {{ $active_supmenu === 'users.index' ? 'active' : '' }}">
                  <i class="fa fa-university nav-icon"></i>
                  <p>معلومات المستخدمين  </p>
                </a>
              </li>
            @endcan
            @can('add_user')
            <li class="nav-item">
              <a href="{{route('users.create')}}" class="nav-link {{ $active_supmenu === 'users.create' ? 'active' : '' }}">
                <i class="fas fa-tasks nav-icon"></i>
                <p> إضافة مستخدم </p>
              </a>
            </li>
            @endcan
            @can('account_setting')
              <li class="nav-item">
                <a href="#" class="nav-link {{ $active_supmenu === 'users.searchedit' ? 'active' : '' }}">
                  <i class="fa fa-book-open nav-icon"></i>
                  <p>تعديل حساب </p>
                </a>
              </li>
              @endcan
              @can('roles')
              <li class="nav-item">
                <a href="{{route("roles.index")}}" class="nav-link {{ $active_supmenu === 'users.searchedit' ? 'active' : '' }}">
                  <i class="fa fa-book-open nav-icon"></i>
                  <p>المهام </p>
                </a>
              </li>
              @endcan
            </ul>
          </li>
        </ul>
      </nav>
    </div>
  </aside>