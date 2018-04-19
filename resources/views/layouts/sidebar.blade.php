  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      {{--  <div class="user-panel">
        <div class="pull-left image">
          <img src="/img/logo.png" class="img-circle" alt="User Image">
        </div>
      </div>  --}}
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">รายการ</li>
        @can('admin')
        <li class="treeview {{ Request::is('auth') || Request::is('role') ? 'active' : null }}">
          <a href="#">
            <i class="far fa-clipboard"></i> <span>จัดการผู้ใช้</span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('auth') ? 'active' : null }}">
              <a href="{{ route('pages.auth.index') }}"><i class="fas fa-users"></i> จัดการผู้ใช้</a>
            </li>
            <li class="{{ Request::is('role') ? 'active' : null }}">
              <a href="{{ route('pages.role.index') }}"><i class="fas fa-users"></i> จัดการสิทธิ</a>
            </li>
          </ul>
        </li>
        @endcan
        <li class="treeview {{ 
          Request::is('customer') ||
          Request::is('customer/*') ||
          Request::is('productionline') || 
          Request::is('productionline/*') || 
          Request::is('model') || 
          Request::is('model/*') || 
          Request::is('jobposition') || 
          Request::is('jobposition/*') || 
          Request::is('process') || 
          Request::is('process/*') || 
          Request::is('type') || 
          Request::is('type/*') || 
          Request::is('material') || 
          Request::is('material/*') || 
          Request::is('lottag') || 
          Request::is('lottag/*') || 
          Request::is('delivery') || 
          Request::is('delivery/*') || 
          Request::is('qpoint') || 
          Request::is('qpoint/*') || 
          Request::is('department') ||
          Request::is('department/*')
          ? 'active' : null }}">
          <a href="#">
            <i class="far fa-clipboard"></i> <span>ค่าเริ่มต้น</span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('productionline') || Request::is('productionline/*') ? 'active' : null }}">
              <a href="{{ route('pages.productionline.index') }}"><i class="fas fa-users"></i> Production Line</a>
            </li>
            <li class="{{ Request::is('model') || Request::is('model/*') ? 'active' : null }}">
              <a href="{{route('pages.model.index')}}"><i class="fas fa-cube"></i> Model</a>
            </li>
            <li class="{{ Request::is('department') || Request::is('department/*') ? 'active' : null }}">
              <a href="{{route('pages.department.index')}}"><i class="fas fa-cube"></i> แผนก</a>
            </li>
            <li class="{{ Request::is('subdepartment') || Request::is('subdepartment/*') ? 'active' : null }}">
              <a href="{{route('pages.subdepartment.index')}}"><i class="fas fa-cube"></i> ฝ่ายย่อยในแผนก</a>
            </li>
            <li class="{{ Request::is('jobposition') || Request::is('jobposition/*') ? 'active' : null }}">
              <a href="{{route('pages.jobposition.index')}}"><i class="fas fa-cube"></i> ตำแหน่งงาน</a>
            </li>
            <li class="{{ Request::is('process') || Request::is('process/*') ? 'active' : null }}">
              <a href="{{route('pages.process.index')}}"><i class="far fa-address-card"></i> Process</a>
            </li>
            <li class="{{ Request::is('type') || Request::is('type/*') ? 'active' : null }}">
              <a href="{{route('pages.type.index')}}"><i class="far fa-address-card"></i> Type</a>
            </li>
            <li class="{{ Request::is('material') || Request::is('material/*') ? 'active' : null }}">
              <a href="{{route('pages.material.index')}}"><i class="far fa-address-card"></i> Material</a>
            </li>
            <li class="{{ Request::is('customer') || Request::is('customer/*') ? 'active' : null }}">
              <a href="{{route('pages.customer.index')}}"><i class="far fa-address-card"></i> Customer</a>
            </li>
            <li class="{{ Request::is('lottag') || Request::is('lottag/*') ? 'active' : null }}">
              <a href="{{route('pages.lottag.index')}}"><i class="fas fa-cubes"></i> Lot Tag</a>
            </li>
            <li class="{{ Request::is('delivery') || Request::is('delivery/*') ? 'active' : null }}">
              <a href="{{route('pages.delivery.index')}}"><i class="fas fa-cubes"></i> Tag Delivery</a>
            </li>
            <li class="{{ Request::is('qpoint') ? 'active' : null }}">
              <a href="{{route('pages.qpoint.index')}}"><i class="fas fa-users"></i> Q-POINT</a>
            </li>
          </ul>
        </li>
        <li class="treeview {{ Request::is('preproductioncheck') ? 'active' : null }}">
          <a href="#">
            <i class="far fa-file-alt"></i> <span>ชิ้นงานก่อนการผลิต</span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('preproductioncheck') ? 'active' : null }}">
              <a href="{{route('pages.preproductioncheck.index')}}"><i class="far fa-file"></i> สร้างรายการ</a>
            </li>
          </ul>
        </li>
        <li class="treeview {{ Request::is('selfcheckproduction') ? 'active' : null }}">
          <a href="#">
            <i class="far fa-file-alt"></i> <span>รายงาน</span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('selfcheckproduction') ? 'active' : null }}">
              <a href="{{route('pages.selfcheckproduction.index')}}"><i class="far fa-file"></i> Self Check Production</a>
            </li>
          </ul>
        </li>
        <li class="treeview {{ Request::is('historyselfcheckproduction') ? 'active' : null }}">
          <a href="#">
            <i class="far fa-file-alt"></i> <span>ประวัติการใช้งาน</span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::is('historyselfcheckproduction') ? 'active' : null }}">
              <a href="{{route('pages.historyselfcheckproduction.index')}}"><i class="far fa-file"></i> Self Check Production</a>
            </li>
          </ul>
        </li>
        {{--  <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Layout Options</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
            <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
            <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
            <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
          </ul>
        </li>  --}}
    
        {{--  <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
        <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>  --}}
        @auth
        <li><a href="{{ route('getsignout.auth') }}"><i class="fas fa-sign-out-alt"></i> <span>Sign out</span></a></li>
        @endauth
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <div class="control-sidebar-bg"></div>