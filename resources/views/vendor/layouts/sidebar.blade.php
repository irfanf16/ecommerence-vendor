<div class="left_sidebar bg-dark ">
    <nav class="sidebar ">

        <ul id="main-menu" class="metismenu text-white mt-3">
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
                    </ul>
                </li>
            @endcan

            {{-- promotions --}}
            <li class="{{ $navItem == 'coupons' ? 'active' : '' }} ">
                <a class="has-arrow text-white">
                    <i class="fas fa-bullhorn text-light"></i>
                    <span>Coupons</span>
                </a>
                <ul>
                    <li>
                        <a href="{{ URL::to('/vendor/coupons/create') }}" class="text-white">Add Coupon</a>
                    </li>
                    <li>
                        <a href="{{ URL::to('/vendor/coupons') }}" class="text-white">Manage Coupons</a>
                    </li>
                </ul>
            </li>

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

            @can('vendor-setting-read')

                <li class="{{ $navItem == 'settings' ? 'active' : '' }} ">
                    <a class="has-arrow text-white">
                        <i class="fas fa-user-cog text-light"></i>
                        <span>Settings</span>
                    </a>
                    <ul>
                        <li class="{{ request()->is('vendor/account') ? 'active' : '' }}">
                            <a href="{{ url('/vendor/account/edit') }}" class="text-white">
                                Account Settings</a>
                        </li>

                    </ul>
                </li>
            @endcan

        </ul>
    </nav>
</div>
