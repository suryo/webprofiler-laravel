<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- BRAND -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/admin') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('assets/admin/img/sidebar_logo_min.png') }}" class="img-fluid" />
        </div>
        <img src="{{ asset('assets/admin/img/sidebar_logo.png') }}" class="img-fluid sidebar-brand-text mx-3" />
    </a>

    <hr class="sidebar-divider my-0">

    <!-- DASHBOARD -->
    <li class="nav-item {{ (request()->is('admin')) ? 'active' : '' }}">
        <a class="nav-link css3animate" href="{{ url('/admin') }}">
            <i class="fas fa-fw fa-tachometer-alt css3animate"></i>
            <span>{{ __('menu.dashboard') }}</span></a>
    </li>

    <hr class="sidebar-divider">

    <!-- PAGES HEADING -->
    <div class="sidebar-heading">
        {{ __('menu.pages') }}
    </div>

    <!-- SLIDERS ITEM -->
    <li class="nav-item {{ (request()->is('admin/sliders*')) ? 'active' : '' }}">
        <a class="nav-link css3animate padding-sm" href="{{ url('/admin/sliders') }}">
            <i class="far fa-images css3animate"></i>
            <span>{{ __('menu.sliders') }}</span>
        </a>
    </li>

    <!-- HOME ITEM -->
    <li class="nav-item {{ (request()->is('admin/personal*') ||
                            request()->is('admin/skills*') ||
                            request()->is('admin/experiences*') ||
                            request()->is('admin/testimonials*') ||
                            request()->is('admin/services*')) ? 'active' : '' }}">
        <a class="nav-link css3animate padding-sm {{ (request()->is('admin/personal*') ||
                                                        request()->is('admin/skills*') ||
                                                        request()->is('admin/experiences*') ||
                                                        request()->is('admin/testimonials*') ||
                                                        request()->is('admin/services*')) ? '' : 'collapsed' }}" data-bs-toggle="collapse" 
            href="#collapseHome" role="button" aria-expanded="false" aria-controls="collapseHome">
            <i class="fas fa-home css3animate"></i>
            <span>{{ __('menu.home') }}</span>
        </a>
        <div id="collapseHome" class="collapse {{ (request()->is('admin/personal*') ||
                                                    request()->is('admin/skills*') ||
                                                    request()->is('admin/experiences*') ||
                                                    request()->is('admin/testimonials*') ||
                                                    request()->is('admin/services*')) ? 'show' : '' }}">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">{{ __('menu.home_sections') }}:</h6>
                <a class="collapse-item {{ request()->is('admin/personal*') ? 'active' : '' }}" href="{{ url('admin/personal') }}">{{ __('menu.personal_info') }}</a>
                <a class="collapse-item {{ request()->is('admin/skills*') ? 'active' : '' }}" href="{{ url('admin/skills') }}">{{ __('menu.skills') }}</a>
                <a class="collapse-item {{ request()->is('admin/experiences*') ? 'active' : '' }}" href="{{ url('admin/experiences') }}">{{ __('menu.experiences') }}</a>
                <a class="collapse-item {{ request()->is('admin/testimonials*') ? 'active' : '' }}" href="{{ url('admin/testimonials') }}">{{ __('menu.testimonials') }}</a>
                <a class="collapse-item {{ request()->is('admin/services*') ? 'active' : '' }}" href="{{ url('admin/services') }}">{{ __('menu.services') }}</a>
            </div>
        </div>
    </li>

    <!-- WORK ITEM -->
    <li class="nav-item {{ (request()->is('admin/work/projects*') ||
                            request()->is('admin/work/project*') ||
                            request()->is('admin/work/categories*')) ? 'active' : '' }}">
        <a class="nav-link css3animate padding-sm {{ (request()->is('admin/work/projects*') ||
                                                        request()->is('admin/work/project*') ||
                                                        request()->is('admin/work/categories*')) ? '' : 'collapsed' }}" data-bs-toggle="collapse" 
            href="#collapseWork" role="button" aria-expanded="false" aria-controls="collapseBlog">
            <i class="fas fa-briefcase css3animate"></i>
            <span>{{ __('menu.work') }}</span>
        </a>
        <div id="collapseWork" class="collapse {{ (request()->is('admin/work/projects*') ||
                                                    request()->is('admin/work/project*') ||
                                                    request()->is('admin/work/categories*')) ? 'show' : '' }}">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">{{ __('menu.work_section') }}:</h6>
                <a class="collapse-item {{ (request()->is('admin/work/projects*') ||
                                            request()->is('admin/work/project*') ) ? 'active' : '' }}" href="{{ url('admin/work/projects') }}">{{ __('menu.projects') }}</a>
                <a class="collapse-item {{ request()->is('admin/work/categories*') ? 'active' : '' }}" href="{{ url('admin/work/categories') }}">{{ __('menu.categories') }}</a>
            </div>
        </div>
    </li>

    <!-- BLOG ITEM -->
    <li class="nav-item {{ (request()->is('admin/blog/posts*') ||
                            request()->is('admin/blog/post*') ||
                            request()->is('admin/blog/categories*')) ? 'active' : '' }}">
        <a class="nav-link css3animate padding-sm {{ (request()->is('admin/blog/posts*') ||
                                                        request()->is('admin/blog/post*') ||
                                                        request()->is('admin/blog/categories*')) ? '' : 'collapsed' }}" data-bs-toggle="collapse" 
            href="#collapseBlog" role="button" aria-expanded="false" aria-controls="collapseBlog">
            <i class="fas fa-comments css3animate"></i>
            <span>{{ __('menu.blog') }}</span>
        </a>
        <div id="collapseBlog" class="collapse {{ (request()->is('admin/blog/posts*') ||
                                                    request()->is('admin/blog/post*') ||
                                                    request()->is('admin/blog/categories*')) ? 'show' : '' }}">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">{{ __('menu.blog_sections') }}:</h6>
                <a class="collapse-item {{ (request()->is('admin/blog/posts*') ||
                                            request()->is('admin/blog/post*') ) ? 'active' : '' }}" href="{{ url('admin/blog/posts') }}">{{ __('menu.posts') }}</a>
                <a class="collapse-item {{ request()->is('admin/blog/categories*') ? 'active' : '' }}" href="{{ url('admin/blog/categories') }}">{{ __('menu.categories') }}</a>
            </div>
        </div>
    </li>

    <!-- CONTACT ITEM -->
    <li class="nav-item pb-2 {{ request()->is('admin/map*') ? 'active' : '' }}">
        <a class="nav-link css3animate padding-sm {{ request()->is('admin/map*') ? '' : 'collapsed' }}" data-bs-toggle="collapse" 
            href="#collapseContact" role="button" aria-expanded="false" aria-controls="collapseContact">
            <i class="fas fa-briefcase css3animate"></i>
            <span>{{ __('menu.contact') }}</span>
        </a>
        <div id="collapseContact" class="collapse {{ request()->is('admin/map*') ? 'show' : '' }}">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">{{ __('menu.contact_sections') }}:</h6>
                <a class="collapse-item {{ request()->is('admin/map*') ? 'active' : '' }}" href="{{ url('admin/map') }}">{{ __('menu.map') }}</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <!-- SETTINGS HEADING -->
    <div class="sidebar-heading">
        {{ __('menu.settings_options') }}
    </div>

    <!-- GENERAL ITEM -->
    <li class="nav-item {{ request()->is('admin/general*') ? 'active' : '' }}">
        <a class="nav-link css3animate padding-sm" href="{{ url('admin/general') }}">
            <i class="fas fa-cog css3animate"></i>
            <span>{{ __('menu.general') }}</span>
        </a>
    </li>

    <!-- STYLES ITEM -->
    <li class="nav-item {{ request()->is('admin/styles*') ? 'active' : '' }}">
        <a class="nav-link css3animate padding-sm" href="{{ url('admin/styles') }}">
            <i class="fas fa-paint-brush css3animate"></i>
            <span>{{ __('menu.styles') }}</span>
        </a>
    </li>

    <!-- SECTIONS ITEM -->
    <li class="nav-item {{ request()->is('admin/sections*') ? 'active' : '' }}">
        <a class="nav-link css3animate padding-sm" href="{{ url('admin/sections') }}">
            <i class="fas fa-puzzle-piece css3animate"></i>
            <span>{{ __('menu.sections') }}</span>
        </a>
    </li>

    <!-- FOOTER ITEM -->
    <li class="nav-item pb-2 {{ request()->is('admin/footer*') ? 'active' : '' }}">
        <a class="nav-link css3animate padding-sm" href="{{ url('admin/footer') }}">
            <i class="fas fa-align-center css3animate"></i>
            <span>{{ __('menu.footer') }}</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- TOGGLE BUTTON -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0 css3animate" id="sidebarToggle"></button>
    </div>

</ul>