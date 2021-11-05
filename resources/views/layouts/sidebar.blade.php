<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
    <i class="la la-close"></i>
</button>
<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark">
    <!-- BEGIN: Aside Menu -->
    <div
        id="m_ver_menu"
        class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark "
        data-menu-vertical="true"
        data-menu-scrollable="false" data-menu-dropdown-timeout="500"
    >
        <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow">
            <li class="m-menu__item @if($menu == 'dashboard') m-menu__item--active @endif" aria-haspopup="true" >
                <a href="{{ route('admin.dashboard') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                {{ __('dashboard') }}
                            </span>
                        </span>
                    </span>
                </a>
            </li>
            <li class="m-menu__item @if($menu == 'user') m-menu__item--active @endif" aria-haspopup="true" >
                <a href="{{ route('admin.user.index') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-users"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                {{ __('user') }}
                            </span>
                        </span>
                    </span>
                </a>
            </li>
            <li class="m-menu__item @if($menu == 'scene') m-menu__item--active @endif" aria-haspopup="true" >
                <a href="{{ route('admin.scene.index') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-layers"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                {{ __('scene') }}
                            </span>
                        </span>
                    </span>
                </a>
            </li>
            <li class="m-menu__item @if($menu == 'category') m-menu__item--active @endif" aria-haspopup="true" >
                <a href="{{ route('admin.category.index') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-share"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                {{ __('category') }}
                            </span>
                        </span>
                    </span>
                </a>
            </li>
            <li class="m-menu__item @if($menu == 'app') m-menu__item--active @endif" aria-haspopup="true" >
                <a href="{{ route('admin.app.index') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-app"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                {{ __('app') }}
                            </span>
                        </span>
                    </span>
                </a>
            </li>
            <li class="m-menu__item @if($menu == 'blog') m-menu__item--active @endif" aria-haspopup="true" >
                <a href="{{ route('admin.blog.index') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-interface-1"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                {{ __('blog') }}
                            </span>
                        </span>
                    </span>
                </a>
            </li>
            <li class="m-menu__item @if($menu == 'blog_category') m-menu__item--active @endif" aria-haspopup="true" >
                <a href="{{ route('admin.blog-category.index') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-list-3"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                {{ __('blog_category') }}
                            </span>
                        </span>
                    </span>
                </a>
            </li>
            <li class="m-menu__item" aria-haspopup="true">
                <a class="m-menu__link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="m-menu__link-icon flaticon-logout"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">{{ __('logout') }}</span>
                        </span>
                    </span>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </a>
            </li>
        </ul>
    </div>
    <!-- END: Aside Menu -->
</div>
