<div class="left_sidebar bg-dark ">
    <nav class="sidebar ">

        <ul id="main-menu" class="metismenu text-white mt-3">

            {{-- dashboard --}}
            {{-- {{ dd(AuthApi::user()) }} --}}


            @can('vendor-dashboard-read')

                <li class="{{ request()->is('vendor/dashboard') ? 'active' : '' }}">
                    <a href="{{ URL::to('/vendor/dashboard') }}">
                        <i class="fas fa-chart-line text-light"></i>
                        <span class="text-white">Dashboard</span>
                    </a>
                </li>
            @endcan

            {{-- products --}}
            @can('vendor-products-read')

                <li class="{{ $navItem == 'products' ? 'active' : '' }} ">
                    <a class="has-arrow text-white">
                        <i class="fas fa-boxes text-light"></i>
                        <span>Products</span>
                    </a>
                    <ul>
                        @can('vendor-products-write')

                            <li>
                                <a href="{{ URL::to('/vendor/products/create') }}" class="text-white">Add Product</a>
                            </li>
                        @endcan
                            <li>
                                <a href="{{ URL::to('/vendor/products') }}" class="text-white">Manage Products</a>
                            </li>

                        {{-- <li>
                        <a href="{{ URL::to('/vendor/products/variants') }}" class="text-white">Manage
                            Variants</a>
                        </li> --}}
                    </ul>
                </li>
            @endcan

            {{-- promotions --}}
            {{-- <li class="{{ $navItem == 'coupons' ? 'active' : '' }} ">
                <a class="has-arrow text-white">
                    <i class="fas fa-bullhorn text-light"></i>
                    <span>Promotions</span>
                </a>
                <ul>
                    <li>
                        <a href="{{ URL::to('/vendor/coupons/create') }}" class="text-white">Add Coupon</a>
                    </li>
                    <li>
                        <a href="{{ URL::to('/vendor/coupons') }}" class="text-white">Manage Coupons</a>
                    </li>
                </ul>
            </li> --}}

            {{-- orders --}}
            @can('vendor-orders-read')

                <li class="{{ $navItem == 'orders' ? 'active' : '' }} ">
                    <a class="has-arrow text-white">
                        <i class="fas fa-dolly-flatbed text-light"></i>
                        <span>Orders</span>
                    </a>
                    <ul>

                            <li class="{{ request()->is('vendor/orders') ? 'active' : '' }}">
                                <a href="{{ URL::to('/vendor/orders') }}" class="text-white">
                                    Manage Orders </a>
                            </li>

                    </ul>
                </li>
            @endcan

            {{--            Product--}}
            @can('vendor-commissions-read')
            <li class="{{ $navItem == 'commissions' ? 'active' : '' }} ">
                <a class="has-arrow text-white">
                    <i class="fas fa-dolly-flatbed text-light"></i>
                    <span>Commission</span>
                </a>
                <ul>
                    <li class="{{ request()->is('vendor/commissions/structure') ? 'active' : '' }}">
                        <a href="{{ URL::to('/vendor/commissions/structure') }}" class="text-white">
                            Commission Structure</a>
                    </li>
                    <li class="{{ request()->is('vendor/commissions') ? 'active' : '' }}">
                        <a href="{{ URL::to('/vendor/commissions') }}" class="text-white">
                            Your Commission</a>
                    </li>
                </ul>
            </li>
            @endcan
            {{--            statistic--}}
            {{--            <li class="{{ $navItem == 'inside' ? 'active' : '' }} ">--}}
            {{--                <a class="has-arrow text-white">--}}
            {{--                    <i class="fas fa-dolly-flatbed text-light"></i>--}}
            {{--                    <span>Inside</span>--}}
            {{--                </a>--}}
            {{--                <ul>--}}
            {{--                    <li class="{{ request()->is('vendor/inside/statistic') ? 'active' : '' }}">--}}
            {{--                        <a href="{{ URL::to('/vendor/inside/statistic') }}" class="text-white">--}}
            {{--                            Statistic</a>--}}
            {{--                    </li>--}}
            {{--                </ul>--}}
            {{--            </li>--}}

            {{--                        statistic--}}
            @can('vendor-reviews-read')

            <li class="{{ $navItem == 'reviews' ? 'active' : '' }} ">
                <a class="has-arrow text-white">
                    <i class="fas fa-dolly-flatbed text-light"></i>
                    <span>Reviews</span>
                </a>
                <ul>

                    <li class="{{ request()->is('vendor/reviews') ? 'active' : '' }}">
                        <a href="{{ URL::to('/vendor/reviews') }}" class="text-white">
                            Reviews</a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('vendor-questions-read')

            <li class="{{ $navItem == 'questions' ? 'active' : '' }} ">
                <a class="has-arrow text-white">
                    <i class="fas fa-dolly-flatbed text-light"></i>
                    <span>Questions</span>
                </a>
                <ul>

                    <li class="{{ request()->is('vendor/questions') ? 'active' : '' }}">
                        <a href="{{ URL::to('/vendor/questions') }}" class="text-white">
                            Questions</a>
                    </li>
                </ul>
            </li>
            @endcan

            @can('vendor-users-read')
            {{-- User Management --}}
            <li class="{{ $navItem == 'users' ? 'active' : '' }} ">
                <a class="has-arrow text-white">
                    <i class="fas fa-user-cog text-light"></i>
                    <span>User Management</span>
                </a>
                <ul>
                    <li class="{{ request()->is('vendor/users') ? 'active' : '' }}">
                        <a href="{{ URL::to('vendor/users') }}" class="text-white">
                            Manage Users </a>
                    </li>

                    <li class="{{ request()->is('vendor/roles') ? 'active' : '' }}">
                        <a href="{{ URL::to('vendor/roles') }}" class="text-white">
                            Manage Roles </a>
                    </li>
                </ul>
            </li>
            @endcan

            {{-- Activity Log --}}
            @can('vendor-log-read')

            <li class="{{ $navItem == 'activity' ? 'active' : '' }} ">
                <a class="has-arrow text-white">
                    <i class="fas fa-user-cog text-light"></i>
                    <span>Activity Log</span>
                </a>
                <ul>
                    <li class="{{ request()->is('/vendor/activities/profile') ? 'active' : '' }}">
                        <a href="{{ url('/vendor/activities/profile') }}" class="text-white">
                            Profile Activities</a>
                    </li>

                </ul>
            </li>
            @endcan
            {{-- settings --}}
            @can('vendor-setting-read')

            <li class="{{ $navItem == 'settings' ? 'active' : '' }} ">
                <a class="has-arrow text-white">
                    <i class="fas fa-user-cog text-light"></i>
                    <span>Settings</span>
                </a>
                <ul>
                    <li class="{{ request()->is('vendor/profile') ? 'active' : '' }}">
                        <a href="{{ url('/vendor/profile/edit') }}" class="text-white">
                            Profile Settings</a>
                    </li>
                    <li class="{{ request()->is('vendor/account') ? 'active' : '' }}">
                        <a href="{{ url('/vendor/account/edit') }}" class="text-white">
                            Account Settings</a>
                    </li>

                    {{-- <li class="{{ request()->is('vendor/profiles') ? 'active' : '' }}">
                        <a href="{{ url('emailformats') }}" class="text-white">
                            Email Formats</a>
                    </li> --}}
                </ul>
            </li>
            @endcan

        </ul>
    </nav>
</div>
