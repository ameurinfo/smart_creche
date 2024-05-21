  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
      <img src="{{asset('backend/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('backend/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview {{ $active_menu === 'children.' ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ $active_menu === 'children.' ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                إدارة اﻷطفال
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('children.index')}}" class="nav-link {{ $active_supmenu === 'children.index' ? 'active' : '' }}">
                  <i class="fa fa-child nav-icon"></i>
                  <p>إدارة معلومات اﻷطفال</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('attendance.create')}}" class="nav-link {{ $active_supmenu === 'attendance.create' ? 'active' : '' }}">
                  <i class="fa fa-list nav-icon"></i>
                  <p>إدارة الحضور والغياب</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('attendance.departure')}}" class="nav-link {{ $active_supmenu === 'attendance.departure' ? 'active' : '' }}">
                  <i class="fas fa-door-open nav-icon"></i>
                  <p>إدارة المغادرة</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('attendance.tracking')}}" class="nav-link {{ $active_supmenu === 'attendance.tracking' ? 'active' : '' }}">
                  <i class="fas fa-paper-plane nav-icon"></i>
                  <p>تتبع الحضور</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('children.createMeals')}}" class="nav-link {{ $active_supmenu === 'children.createMeals' ? 'active' : '' }}">
                  <i class="fas fa-paper-plane nav-icon"></i>
                  <p>تتبع الوجبات</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('children.createSleep')}}" class="nav-link {{ $active_supmenu === 'children.createSleep' ? 'active' : '' }}">
                  <i class="fas fa-paper-plane nav-icon"></i>
                  <p>تتبع النوم</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview {{ $active_menu === 'children' ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ $active_menu === 'children' ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                إدارة الصفوف واﻷنشطة
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('attendance.departure')}}" class="nav-link {{ $active_supmenu === 'attendance.departure' ? 'active' : '' }}">
                <i class="fas fa-tasks nav-icon"></i>
                <p>إدارة اﻷنشطة</p>
              </a>
            </li>
              <li class="nav-item">
                <a href="{{route('children.index')}}" class="nav-link {{ $active_supmenu === 'children.index' ? 'active' : '' }}">
                  <i class="fa fa-university nav-icon"></i>
                  <p>إدارة الصفوف </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('attendance.create')}}" class="nav-link {{ $active_supmenu === 'attendance.create' ? 'active' : '' }}">
                  <i class="fa fa-book-open nav-icon"></i>
                  <p>إدارة المناهج </p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview {{ $active_menu === 'children' ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ $active_menu === 'children' ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                إدارة الصحة والسلامة
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('children.index')}}" class="nav-link {{ $active_supmenu === 'children.index' ? 'active' : '' }}">
                  <i class="fa fa-university nav-icon"></i>
                  <p>السجلات الصحية </p>
                </a>
              </li>
            <li class="nav-item">
              <a href="#" class="nav-link {{ $active_supmenu === 'attendance.departure' ? 'active' : '' }}">
                <i class="fas fa-tasks nav-icon"></i>
                <p>المتابعة الصحية </p>
              </a>
            </li>
              <li class="nav-item">
                <a href="{{route('attendance.create')}}" class="nav-link {{ $active_supmenu === 'attendance.create' ? 'active' : '' }}">
                  <i class="fa fa-book-open nav-icon"></i>
                  <p>المتابعة النفسية </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('attendance.create')}}" class="nav-link {{ $active_supmenu === 'attendance.create' ? 'active' : '' }}">
                  <i class="fa fa-book-open nav-icon"></i>
                  <p>المتابعة التربوية </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('attendance.create')}}" class="nav-link {{ $active_supmenu === 'attendance.create' ? 'active' : '' }}">
                  <i class="fa fa-book-open nav-icon"></i>
                  <p>إدارة الحوادث </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('attendance.create')}}" class="nav-link {{ $active_supmenu === 'attendance.create' ? 'active' : '' }}">
                  <i class="fa fa-book-open nav-icon"></i>
                  <p>بث مباشر</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview {{ $active_menu === 'staff' ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ $active_menu === 'staff' ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                إدارة الموظفين
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('staff.index')}}" class="nav-link {{ $active_supmenu === 'staff.index' ? 'active' : '' }}">
                  <i class="fa fa-university nav-icon"></i>
                  <p>معلومات الموظفين  </p>
                </a>
              </li>
            <li class="nav-item">
              <a href="#" class="nav-link {{ $active_supmenu === 'attendance.departure' ? 'active' : '' }}">
                <i class="fas fa-tasks nav-icon"></i>
                <p> إضافة موظف </p>
              </a>
            </li>
              <li class="nav-item">
                <a href="{{route('attendance.create')}}" class="nav-link {{ $active_supmenu === 'attendance.create' ? 'active' : '' }}">
                  <i class="fa fa-book-open nav-icon"></i>
                  <p>جدولة العمل </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('attendance.create')}}" class="nav-link {{ $active_supmenu === 'attendance.create' ? 'active' : '' }}">
                  <i class="fa fa-book-open nav-icon"></i>
                  <p>تتبع الحضور </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('attendance.create')}}" class="nav-link {{ $active_supmenu === 'attendance.create' ? 'active' : '' }}">
                  <i class="fa fa-book-open nav-icon"></i>
                  <p>إدارة الرواتب </p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
    </div>
  </aside>