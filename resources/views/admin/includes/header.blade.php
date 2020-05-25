
<div class="container-fluid" style="position: fixed; top: 0; left: 0; width: 100%; z-index: 999;">
    <div id="card-head">
        <div style="display: flex; ">
            <div style="flex: 1; margin-bottom: 5px; margin-top: 5px;">
                <div style="display: flex">
                    <div style="flex: 1">
                        <div class="card">
                            <a href="{{ route('admin') }}"><i class="fa fa-calendar-o" aria-hidden="true"></i> <span class="mini-dn">Thời khóa biểu</span>
                            </a>
                        </div>
                    </div>
                    <div style="flex: 1">
                        <div class="card">
                            <a href="{{ route('admin.phong') }}"><i class="fa fa-fort-awesome" aria-hidden="true"></i> <span class="mini-dn">Phòng</span>
                            </a>
                        </div>
                    </div>
                    <div style="flex: 1">
                        <div class="card">
                            <a href="{{ route('admin.phanmem') }}"><i class="fa fa-adn" aria-hidden="true"></i> <span class="mini-dn">Phẩn mềm</span>
                            </a>
                        </div>
                    </div>
                    <div style="flex: 1">
                        <div class="card">
                            <a href="{{ route('admin.hocphan') }}"><i class="fa fa-leanpub" aria-hidden="true"></i> <span class="mini-dn">Học phần</span>
                            </a>
                        </div>
                    </div>
                    <div style="flex: 1">
                        <div class="card">
                            <a href="{{ route('admin.thoikhoabieu') }}"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> <span class="mini-dn">Lịch</span>
                            </a>
                        </div>
                    </div>
                    <div style="flex: 1">
                        <div class="card">
                            <a href="{{ route('admin.canbo') }}"><i class="fa fa-black-tie" aria-hidden="true"></i> <span class="mini-dn">Cán bộ</span>
                            </a>
                        </div>
                    </div>
                    <div style="flex: 1">
                        <div class="card">
                            <a href="{{ route('auto') }}"><i class="fa fa-empire" aria-hidden="true"></i> <span class="mini-dn">Auto</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div style="flex-basis: auto">
                <ul class="nav navbar-nav mai-top-nav header-right-menu">
                    <li class="nav-item">
                        <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                            <span class="adminpro-icon adminpro-user-rounded header-riht-inf"></span>
                            <span class="admin-name">Admin</span>
                            <span class="author-project-icon adminpro-icon adminpro-down-arrow"></span>
                        </a>
                        <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated flipInX">
                            <li><a href="{{route('logout')}}"><p class="text-center">Đăng xuất</p></a>
                            </li>

                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        
    </div>
</div>
