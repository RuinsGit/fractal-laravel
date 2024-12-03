<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- User details -->
        <div class="user-profile text-center mt-3">
            <div class="">
                <img src="{{ asset('back/assets/images/logo-eneraz.webp') }}" width="80" alt="">
            </div>
            <div class="mt-3">
                <h4 class="font-size-16 mb-1">{{ auth()->user()->name }}</h4>
                <span class="text-muted"><i class="ri-record-circle-line align-middle font-size-14 text-success"></i>
                    Online</span>
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="menu-item has-submenu">
                    <a href="#" class="waves-effect">
                        <i class="ri-home-line"></i>
                        <span>Ana Səhifə</span>
                        <i class="ri-arrow-down-s-line submenu-arrow"></i>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('admin.home.header.index') }}">Başlıq</a></li>
                        <li><a href="">Üstünlüklərimiz</a></li>
                        <li><a href="">Təhsil Proqramı</a></li>
                        <li><a href="">Navbar</a></li>
                        <li><a href="">Tərəfdaşlar</a></li>
                        <li><a href="">Xidmətlər</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('admin.category.index') }}" class="waves-effect">
                        <i class="ri-list-check"></i>
                        <span>Kateqoriyalar</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.sub-category.index') }}" class="waves-effect">
                        <i class="ri-list-ordered"></i>
                        <span>Alt Kateqoriyalar</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.product.index') }}" class="waves-effect">
                        <i class="ri-shopping-cart-line"></i>
                        <span>Məhsullar</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.service.index') }}" class="waves-effect">
                        <i class="ri-customer-service-line"></i>
                        <span>Xidmətlər</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.blog.index') }}" class="waves-effect">
                        <i class="ri-article-line"></i>
                        <span>Xəbərlər</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.order.index') }}" class="waves-effect">
                        <i class="ri-shopping-basket-line"></i>
                        <span>Sifarişlər</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.comment.index') }}" class="waves-effect">
                        <i class="ri-chat-quote-line"></i>
                        <span>Rəylər</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.leader.index') }}" class="waves-effect">
                        <i class="ri-team-line"></i>
                        <span>Rəhbərlik</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.gallery.index') }}" class="waves-effect">
                        <i class="ri-gallery-line"></i>
                        <span>Qalereya</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-settings-2-line"></i>
                        <span>Tənzimləmələr</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('admin.about') }}">
                                <i class="ri-information-line"></i>
                                Haqqımızda
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.contact') }}">
                                <i class="ri-contacts-line"></i>
                                Əlaqə
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.contact-message.index') }}">
                                <i class="ri-message-2-line"></i>
                                Əlaqə müraciətləri
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->