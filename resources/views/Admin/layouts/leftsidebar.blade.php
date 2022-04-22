<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{url('dashboard_admin_panel/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{Auth::guard('admin')->user()->name}}</p>            
                <i class="fa fa-circle text-success"></i> @lang('leftsidebar.online')
            </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">
                @if(App::getLocale() == "en")
                    <a href="{{url('admin/lang/ar')}}" style="color: #f0f0f0">عربي</a>
                @else
                    <a href="{{url('admin/lang/en')}}" style="color: #f0f0f0;">English</a>
                @endif
            </li>
            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i>
                    <span>@lang('leftsidebar.Control Panel')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li>
                        <a href="{{url('admin/Admin/adminInfo')}}" id="Admin">
                            <i class="fa fa-user-md"></i>@lang('leftsidebar.Admins')
                        </a>
                    </li>

                    <li>
                        <a href="{{url('admin/Role/rolesInfo')}}" id="Role">
                            <i class="fa fa-flash"></i>@lang('leftsidebar.Roles')
                        </a>
                    </li>

                    <li>
                        <a href="{{url('admin/Permission/permissionsInfo')}}" id="Permission">
                            <i class="fa fa-hand-rock-o"></i>@lang('leftsidebar.Permissions')
                        </a>
                    </li>

                    <li>
                        <a href="{{url('admin/User/userInfo')}}" id="User">
                            <i class="fa fa-users"></i>@lang('leftsidebar.Users')
                        </a>
                    </li>

                    <li>
                        <a href="{{url('admin/Main_type/mainTypesInfo')}}" id="Main_type">
                            <i class="fa fa-magic"></i>@lang('leftsidebar.MainTypes')
                        </a>
                    </li>

                    <li>
                        <a href="{{url('admin/Category/categoriesInfo')}}" id="Category">
                            <i class="fa fa-th"></i>@lang('leftsidebar.Categories')
                        </a>
                    </li>

                    <li>
                        <a href="{{url('admin/S_category/s_categoriesInfo')}}" id="S_category">
                            <i class="fa fa-reorder"></i>@lang('leftsidebar.S_categories')
                        </a>
                    </li>

                    <li>
                        <a href="{{url('admin/Size/sizesInfo')}}" id="Size">
                            <i class="fa fa-gg-circle"></i>@lang('leftsidebar.Sizes')
                        </a>
                    </li>

                    <li>
                        <a href="{{url('admin/Measur_unit/measurUnitsInfo')}}" id="Measur_unit">
                            <i class="fa fa-balance-scale"></i>@lang('leftsidebar.MeasurUnits')
                        </a>
                    </li>

                    <li>
                        <a href="{{url('admin/Setting/generalSetting')}}" id="Setting">
                            <i class="fa fa-cogs"></i>@lang('leftsidebar.Setting')
                        </a>
                    </li>

                    <li>
                        <a href="{{url('admin/Country/countriesInfo')}}" id="Country">
                            <i class="fa fa-flag-checkered"></i>@lang('leftsidebar.Countries')
                        </a>
                    </li>

                    <li>
                        <a href="{{url('admin/City/citiesInfo')}}" id="City">
                            <i class="fa fa-flag-o"></i>@lang('leftsidebar.Cities')
                        </a>
                    </li>

                    <li>
                        <a href="{{url('admin/State/statesInfo')}}" id="State">
                            <i class="fa fa-flag"></i>@lang('leftsidebar.States')
                        </a>
                    </li>

                    <li>
                        <a href="{{url('admin/Brand/brandsInfo')}}" id="Brand">
                            <i class="fa fa-heart-o"></i>@lang('leftsidebar.Brands')
                        </a>
                    </li>

                    <li>
                        <a href="{{url('admin/Color/colorsInfo')}}" id="Color">
                            <i class="fa fa-circle-o"></i>@lang('leftsidebar.Colors')
                        </a>
                    </li>

                    <li>
                        <a href="{{url('admin/Item/itemsInfo')}}" id="Item">
                            <i class="fa fa-gift"></i>@lang('leftsidebar.Items')
                        </a>
                    </li>

                    <li>
                        <a href="{{url('admin/Vendor/vendorInfo')}}" id="Vendor">
                            <i class="fa fa-gift"></i>@lang('leftsidebar.Vendors')
                        </a>
                    </li>

                </ul>
            </li> 
        </ul>
    </section>
</aside>