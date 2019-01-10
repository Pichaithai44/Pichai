  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
        <li><a href="{{ route('pages.settingsystem.index') }}"><i class="fas fa-sign-out-alt"></i> <span>ตั้งค่าระบบ</span></a></li>
        <li><a href="{{ route('pages.settinguser.index') }}"><i class="fas fa-sign-out-alt"></i> <span>ตั้งค่าผู้ใช้งาน</span></a></li>
        <li><a href="{{ route('pages.pledge.index') }}"><i class="fas fa-sign-out-alt"></i> <span>จำนำของ</span></a></li>
        <li class="treeview {{ Request::is('selfcheckproduction') ? 'active' : null }}">
          <a href="#">
            <i class="far fa-file-alt"></i> <span>รายงาน</span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('selfcheckproduction') ? 'active' : null }}">
              <a href=""><i class="far fa-file"></i> รายงานของในระบบ</a>
            </li>
            <li class="{{ Request::is('selfcheckproduction') ? 'active' : null }}">
              <a href=""><i class="far fa-file"></i> รายงานชำระค่างวด</a>
            </li>
            <li class="{{ Request::is('selfcheckproduction') ? 'active' : null }}">
              <a href=""><i class="far fa-file"></i> รายงานของออกจากระบบ</a>
            </li>
          </ul>
        </li>
        <li><a href=""><i class="fas fa-sign-out-alt"></i> <span>ตรวจสอบสถานะผู้จำนำ</span></a></li>
        @auth
        <li><a href="{{ route('getsignout.auth') }}"><i class="fas fa-sign-out-alt"></i> <span>Sign out</span></a></li>
        @endauth
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <div class="control-sidebar-bg"></div>