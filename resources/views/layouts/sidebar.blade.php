  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
        <li><a href="{{ route('pages.settingsystem.index') }}"><i class="fas fa-cogs"></i> <span> ตั้งค่าระบบ</span></a></li>
        <li><a href="{{ route('pages.settinguser.index') }}"><i class="fas fa-user"></i> <span> ระบบสมาชิก</span></a></li>
        <li><a href="{{ route('pages.pledge.index') }}"><i class="fab fa-bitcoin"></i> <span>ระบบจำนำสินค้า</span></a></li>
        <li class="treeview {{ Request::is('selfcheckproduction') ? 'active' : null }}">
          <a href="#">
            <i class="fas fa-map"></i> <span>รายงาน</span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('selfcheckproduction') ? 'active' : null }}">
              <a href=""><i class="far fa-map"></i> รายงานของในระบบ</a>
            </li>
            <li class="{{ Request::is('selfcheckproduction') ? 'active' : null }}">
              <a href=""><i class="far fa-map"></i> รายงานชำระค่างวด</a>
            </li>
            <li class="{{ Request::is('selfcheckproduction') ? 'active' : null }}">
              <a href=""><i class="far fa-map"></i> รายงานของออกจากระบบ</a>
            </li>
          </ul>
        </li>
        <!-- <li><a href=""><i class="fas fa-sign-out-alt"></i> <span>ตรวจสอบสถานะผู้จำนำ</span></a></li> -->
        @auth
        <li><a href="{{ route('getsignout.auth') }}"><i class="fas fa-sign-out-alt"></i> <span>Sign out</span></a></li>
        @endauth
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <div class="control-sidebar-bg"></div>