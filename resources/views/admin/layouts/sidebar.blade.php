  <!-- ========== Left Sidebar Start ========== -->
  <div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li>
                    <a href="{{route('panel.dashboard')}}" class="waves-effect">
                        <i class="dripicons-meter"></i><span> داشبورد </span>
                    </a>
                </li>

                <li>
                    <a href="{{route('panel.admins.index')}}" class="waves-effect"><i class="dripicons-user-group"></i><span>  مدیران </span></a>
                </li>
                <li>
                    <a href="{{route('panel.users.index')}}" class="waves-effect"><i class="dripicons-user-group"></i><span> کاربران </span></a>
                </li>

                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-bullhorn"></i><span> محصولات فروشگاه <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="{{route('panel.product_categories.index')}}">دسته بندی </a></li>
                        <li><a href="{{route('panel.products.index')}}"> محصولات</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-bullhorn"></i><span> مدیریت پسماند <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="{{route('panel.pasmands.index')}}">لیست پسماند</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-camera-image"></i><span> مدیریت اسلاید <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="{{route('panel.stories.index')}}">استوری</a></li>
                        <li><a href="{{route('panel.banners.index')}}">بنر</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-to-do"></i><span>  اطلاعات عمومی و اخبار <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="{{route('panel.article_categories.index')}}">دسته بندی محتوا</a></li>
                        <li><a href="{{route('panel.articles.index')}}">محتوا</a></li>
                    </ul>
                </li>
                @include('Padideh.padideh-sidebar')
                <li>
                    <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-to-do"></i><span> رانندگان <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                    <ul class="submenu">
                        <li><a href="{{route('panel.drivers.lists.index')}}">لیست راننده ها</a></li>
                        <li><a href="{{route('panel.drivers.statuses.index')}}">وضعیت </a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{route('panel.users.index')}}" class="waves-effect"><i class="dripicons-user-group"></i><span> تنظیمات </span></a>
                </li>
                <li>
                    <a href="{{route('panel.users.index')}}" class="waves-effect"><i class="dripicons-user-group"></i><span> خروج </span></a>
                </li>
            </ul>

        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
