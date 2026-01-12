@php
    use App\Helpers\IconsHelper;

    $currentPath = request()->path();

    $dashboardPath = parse_url(route('dashboard'), PHP_URL_PATH);
    $calendarPath = parse_url(route('calendar'), PHP_URL_PATH);
    $profilePath = parse_url(route('profile'), PHP_URL_PATH);
    $formElementsPath = parse_url(route('form-elements'), PHP_URL_PATH);
    $basicTablesPath = parse_url(route('basic-tables'), PHP_URL_PATH);
    $blankPath = parse_url(route('blank'), PHP_URL_PATH);
    $errorPath = parse_url(route('error-404'), PHP_URL_PATH);
    $lineChartPath = parse_url(route('line-chart'), PHP_URL_PATH);
    $barChartPath = parse_url(route('bar-chart'), PHP_URL_PATH);
    $alertsPath = parse_url(route('alerts'), PHP_URL_PATH);
    $avatarsPath = parse_url(route('avatars'), PHP_URL_PATH);
    $badgesPath = parse_url(route('badges'), PHP_URL_PATH);
    $buttonsPath = parse_url(route('buttons'), PHP_URL_PATH);
    $imagesPath = parse_url(route('images'), PHP_URL_PATH);
    $videosPath = parse_url(route('videos'), PHP_URL_PATH);
    $signinPath = parse_url(route('signin'), PHP_URL_PATH);
    $signupPath = parse_url(route('signup'), PHP_URL_PATH);
@endphp

<aside id="sidebar"
    class="fixed flex flex-col mt-0 top-0 px-5 left-0 rtl:left-auto rtl:right-0 bg-white dark:bg-gray-900 dark:border-gray-800 text-gray-900 h-screen transition-all duration-300 ease-in-out z-99999 border-r border-gray-200 rtl:border-r-0 rtl:border-l"
    x-data="{
        openSubmenus: {},
        init() {
            this.initializeActiveMenus();
        },
        initializeActiveMenus() {
            const currentPath = '{{ $currentPath }}';
            this.openSubmenus = {
                'menu-dashboard': currentPath === '' || currentPath === '{{ ltrim($dashboardPath, '/') }}' || window.location.pathname === '{{ $dashboardPath }}',
                'menu-forms': currentPath === '{{ ltrim($formElementsPath, '/') }}' || window.location.pathname === '{{ $formElementsPath }}',
                'menu-tables': currentPath === '{{ ltrim($basicTablesPath, '/') }}' || window.location.pathname === '{{ $basicTablesPath }}',
                'menu-pages': currentPath === '{{ ltrim($blankPath, '/') }}' || currentPath === '{{ ltrim($errorPath, '/') }}' ||
                    window.location.pathname === '{{ $blankPath }}' || window.location.pathname === '{{ $errorPath }}',
                'menu-charts': currentPath === '{{ ltrim($lineChartPath, '/') }}' || currentPath === '{{ ltrim($barChartPath, '/') }}' ||
                    window.location.pathname === '{{ $lineChartPath }}' || window.location.pathname === '{{ $barChartPath }}',
                'menu-ui': currentPath === '{{ ltrim($alertsPath, '/') }}' || currentPath === '{{ ltrim($avatarsPath, '/') }}' ||
                    currentPath === '{{ ltrim($badgesPath, '/') }}' || currentPath === '{{ ltrim($buttonsPath, '/') }}' ||
                    currentPath === '{{ ltrim($imagesPath, '/') }}' || currentPath === '{{ ltrim($videosPath, '/') }}' ||
                    window.location.pathname === '{{ $alertsPath }}' || window.location.pathname === '{{ $avatarsPath }}' ||
                    window.location.pathname === '{{ $badgesPath }}' || window.location.pathname === '{{ $buttonsPath }}' ||
                    window.location.pathname === '{{ $imagesPath }}' || window.location.pathname === '{{ $videosPath }}',
                'menu-auth': currentPath === '{{ ltrim($signinPath, '/') }}' || currentPath === '{{ ltrim($signupPath, '/') }}' ||
                    window.location.pathname === '{{ $signinPath }}' || window.location.pathname === '{{ $signupPath }}'
            };
        },
        toggleSubmenu(key) {
            const newState = !this.openSubmenus[key];
            if (newState) {
                this.openSubmenus = {};
            }
            this.openSubmenus[key] = newState;
        },
        isSubmenuOpen(key) {
            return this.openSubmenus[key] || false;
        },
        isActive(path) {
            return window.location.pathname === path || '{{ $currentPath }}' === path.replace(/^\//, '');
        }
    }"
    :class="{
        'w-[290px]': $store.sidebar.isExpanded || $store.sidebar.isMobileOpen || $store.sidebar.isHovered,
        'w-[90px]': !$store.sidebar.isExpanded && !$store.sidebar.isHovered,
        'translate-x-0': $store.sidebar.isMobileOpen,
        '-translate-x-full xl:translate-x-0 rtl:translate-x-full rtl:xl:translate-x-0': !$store.sidebar.isMobileOpen
    }"
    @mouseenter="if (!$store.sidebar.isExpanded) $store.sidebar.setHovered(true)"
    @mouseleave="$store.sidebar.setHovered(false)">
    <!-- Logo Section -->
    <div class="pt-8 pb-7 flex"
        :class="(!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ?
        'xl:justify-center' :
        'justify-start'">
        <a href="{{ route('dashboard') }}">
            <img x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                class="dark:hidden" src="/images/logo/logo.svg" alt="Logo" width="150" height="40" />
            <img x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                class="hidden dark:block" src="/images/logo/logo-dark.svg" alt="Logo" width="150"
                height="40" />
            <img x-show="!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen"
                src="/images/logo/logo-icon.svg" alt="Logo" width="32" height="32" />
        </a>
    </div>

    <!-- Navigation Menu -->
    <div class="flex flex-col overflow-y-auto duration-300 ease-linear no-scrollbar">
        <nav class="mb-6">
            <div class="flex flex-col gap-4">
                <div>
                    <!-- Menu Group Title -->
                    <h2 class="mb-4 text-xs uppercase flex leading-[20px] text-gray-400"
                        :class="(!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ?
                        'lg:justify-center' : 'justify-start'">
                        <template
                            x-if="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen">
                            <span>Menu</span>
                        </template>
                        <template x-if="!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen">
                            {!! IconsHelper::icon('dots-horizontal') !!}
                        </template>
                    </h2>

                    <!-- Menu Items -->
                    <ul class="flex flex-col gap-1">
                        <li>
                            <button @click="toggleSubmenu('menu-dashboard')"
                                class="menu-item group w-full"
                                :class="[
                                    isSubmenuOpen('menu-dashboard') ? 'menu-item-active' : 'menu-item-inactive',
                                    !$store.sidebar.isExpanded && !$store.sidebar.isHovered ? 'xl:justify-center' : 'xl:justify-start'
                                ]">
                                <span :class="isSubmenuOpen('menu-dashboard') ? 'menu-item-icon-active' : 'menu-item-icon-inactive'">
                                    {!! IconsHelper::icon('dashboard') !!}
                                </span>
                                <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                                    class="menu-item-text flex items-center gap-2">
                                    Dashboard
                                </span>
                                <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                                    class="ml-auto rtl:ml-0 rtl:mr-auto w-5 h-5 transition-transform duration-200"
                                    :class="{ 'rotate-180 text-brand-500': isSubmenuOpen('menu-dashboard') }">
                                    {!! IconsHelper::icon('chevron-down', 'w-5 h-5') !!}
                                </span>
                            </button>
                            <div x-show="isSubmenuOpen('menu-dashboard') && ($store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen)">
                                <ul class="mt-2 space-y-1 ml-9 rtl:ml-0 rtl:mr-9">
                                    <li>
                                        <a href="{{ route('dashboard') }}" class="menu-dropdown-item"
                                            :class="isActive('{{ $dashboardPath }}') ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                                            Ecommerce
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="{{ route('calendar') }}" class="menu-item group"
                                :class="[isActive('{{ $calendarPath }}') ? 'menu-item-active' : 'menu-item-inactive', (!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ? 'xl:justify-center' : 'justify-start']">
                                <span :class="isActive('{{ $calendarPath }}') ? 'menu-item-icon-active' : 'menu-item-icon-inactive'">
                                    {!! IconsHelper::icon('calendar') !!}
                                </span>
                                <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen" class="menu-item-text flex items-center gap-2">
                                    Calendar
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('profile') }}" class="menu-item group"
                                :class="[isActive('{{ $profilePath }}') ? 'menu-item-active' : 'menu-item-inactive', (!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ? 'xl:justify-center' : 'justify-start']">
                                <span :class="isActive('{{ $profilePath }}') ? 'menu-item-icon-active' : 'menu-item-icon-inactive'">
                                    {!! IconsHelper::icon('user-profile') !!}
                                </span>
                                <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen" class="menu-item-text flex items-center gap-2">
                                    User Profile
                                </span>
                            </a>
                        </li>
                        <li>
                            <button @click="toggleSubmenu('menu-forms')" class="menu-item group w-full"
                                :class="[isSubmenuOpen('menu-forms') ? 'menu-item-active' : 'menu-item-inactive', !$store.sidebar.isExpanded && !$store.sidebar.isHovered ? 'xl:justify-center' : 'xl:justify-start']">
                                <span :class="isSubmenuOpen('menu-forms') ? 'menu-item-icon-active' : 'menu-item-icon-inactive'">
                                    {!! IconsHelper::icon('forms') !!}
                                </span>
                                <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen" class="menu-item-text flex items-center gap-2">
                                    Forms
                                </span>
                                <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                                    class="ml-auto rtl:ml-0 rtl:mr-auto w-5 h-5 transition-transform duration-200"
                                    :class="{ 'rotate-180 text-brand-500': isSubmenuOpen('menu-forms') }">
                                    {!! IconsHelper::icon('chevron-down', 'w-5 h-5') !!}
                                </span>
                            </button>
                            <div x-show="isSubmenuOpen('menu-forms') && ($store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen)">
                                <ul class="mt-2 space-y-1 ml-9 rtl:ml-0 rtl:mr-9">
                                    <li>
                                        <a href="{{ route('form-elements') }}" class="menu-dropdown-item"
                                            :class="isActive('{{ $formElementsPath }}') ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                                            Form Elements
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <button @click="toggleSubmenu('menu-tables')" class="menu-item group w-full"
                                :class="[isSubmenuOpen('menu-tables') ? 'menu-item-active' : 'menu-item-inactive', !$store.sidebar.isExpanded && !$store.sidebar.isHovered ? 'xl:justify-center' : 'xl:justify-start']">
                                <span :class="isSubmenuOpen('menu-tables') ? 'menu-item-icon-active' : 'menu-item-icon-inactive'">
                                    {!! IconsHelper::icon('tables') !!}
                                </span>
                                <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen" class="menu-item-text flex items-center gap-2">
                                    Tables
                                </span>
                                <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                                    class="ml-auto rtl:ml-0 rtl:mr-auto w-5 h-5 transition-transform duration-200"
                                    :class="{ 'rotate-180 text-brand-500': isSubmenuOpen('menu-tables') }">
                                    {!! IconsHelper::icon('chevron-down', 'w-5 h-5') !!}
                                </span>
                            </button>
                            <div x-show="isSubmenuOpen('menu-tables') && ($store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen)">
                                <ul class="mt-2 space-y-1 ml-9 rtl:ml-0 rtl:mr-9">
                                    <li>
                                        <a href="{{ route('basic-tables') }}" class="menu-dropdown-item"
                                            :class="isActive('{{ $basicTablesPath }}') ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                                            Basic Tables
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <button @click="toggleSubmenu('menu-pages')" class="menu-item group w-full"
                                :class="[isSubmenuOpen('menu-pages') ? 'menu-item-active' : 'menu-item-inactive', !$store.sidebar.isExpanded && !$store.sidebar.isHovered ? 'xl:justify-center' : 'xl:justify-start']">
                                <span :class="isSubmenuOpen('menu-pages') ? 'menu-item-icon-active' : 'menu-item-icon-inactive'">
                                    {!! IconsHelper::icon('pages') !!}
                                </span>
                                <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen" class="menu-item-text flex items-center gap-2">
                                    Pages
                                </span>
                                <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                                    class="ml-auto rtl:ml-0 rtl:mr-auto w-5 h-5 transition-transform duration-200"
                                    :class="{ 'rotate-180 text-brand-500': isSubmenuOpen('menu-pages') }">
                                    {!! IconsHelper::icon('chevron-down', 'w-5 h-5') !!}
                                </span>
                            </button>
                            <div x-show="isSubmenuOpen('menu-pages') && ($store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen)">
                                <ul class="mt-2 space-y-1 ml-9 rtl:ml-0 rtl:mr-9">
                                    <li>
                                        <a href="{{ route('blank') }}" class="menu-dropdown-item"
                                            :class="isActive('{{ $blankPath }}') ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                                            Blank Page
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('error-404') }}" class="menu-dropdown-item"
                                            :class="isActive('{{ $errorPath }}') ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                                            404 Error
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>

                <div>
                    <!-- Menu Group Title -->
                    <h2 class="mb-4 text-xs uppercase flex leading-[20px] text-gray-400"
                        :class="(!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen) ?
                        'lg:justify-center' : 'justify-start'">
                        <template
                            x-if="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen">
                            <span>Others</span>
                        </template>
                        <template x-if="!$store.sidebar.isExpanded && !$store.sidebar.isHovered && !$store.sidebar.isMobileOpen">
                            {!! IconsHelper::icon('dots-horizontal') !!}
                        </template>
                    </h2>

                    <!-- Menu Items -->
                    <ul class="flex flex-col gap-1">
                        <li>
                            <button @click="toggleSubmenu('menu-charts')" class="menu-item group w-full"
                                :class="[isSubmenuOpen('menu-charts') ? 'menu-item-active' : 'menu-item-inactive', !$store.sidebar.isExpanded && !$store.sidebar.isHovered ? 'xl:justify-center' : 'xl:justify-start']">
                                <span :class="isSubmenuOpen('menu-charts') ? 'menu-item-icon-active' : 'menu-item-icon-inactive'">
                                    {!! IconsHelper::icon('charts') !!}
                                </span>
                                <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen" class="menu-item-text flex items-center gap-2">
                                    Charts
                                </span>
                                <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                                    class="ml-auto rtl:ml-0 rtl:mr-auto w-5 h-5 transition-transform duration-200"
                                    :class="{ 'rotate-180 text-brand-500': isSubmenuOpen('menu-charts') }">
                                    {!! IconsHelper::icon('chevron-down', 'w-5 h-5') !!}
                                </span>
                            </button>
                            <div x-show="isSubmenuOpen('menu-charts') && ($store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen)">
                                <ul class="mt-2 space-y-1 ml-9 rtl:ml-0 rtl:mr-9">
                                    <li>
                                        <a href="{{ route('line-chart') }}" class="menu-dropdown-item"
                                            :class="isActive('{{ $lineChartPath }}') ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                                            Line Chart
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('bar-chart') }}" class="menu-dropdown-item"
                                            :class="isActive('{{ $barChartPath }}') ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                                            Bar Chart
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <button @click="toggleSubmenu('menu-ui')" class="menu-item group w-full"
                                :class="[isSubmenuOpen('menu-ui') ? 'menu-item-active' : 'menu-item-inactive', !$store.sidebar.isExpanded && !$store.sidebar.isHovered ? 'xl:justify-center' : 'xl:justify-start']">
                                <span :class="isSubmenuOpen('menu-ui') ? 'menu-item-icon-active' : 'menu-item-icon-inactive'">
                                    {!! IconsHelper::icon('ui-elements') !!}
                                </span>
                                <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen" class="menu-item-text flex items-center gap-2">
                                    UI Elements
                                </span>
                                <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                                    class="ml-auto rtl:ml-0 rtl:mr-auto w-5 h-5 transition-transform duration-200"
                                    :class="{ 'rotate-180 text-brand-500': isSubmenuOpen('menu-ui') }">
                                    {!! IconsHelper::icon('chevron-down', 'w-5 h-5') !!}
                                </span>
                            </button>
                            <div x-show="isSubmenuOpen('menu-ui') && ($store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen)">
                                <ul class="mt-2 space-y-1 ml-9 rtl:ml-0 rtl:mr-9">
                                    <li>
                                        <a href="{{ route('alerts') }}" class="menu-dropdown-item"
                                            :class="isActive('{{ $alertsPath }}') ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                                            Alerts
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('avatars') }}" class="menu-dropdown-item"
                                            :class="isActive('{{ $avatarsPath }}') ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                                            Avatar
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('badges') }}" class="menu-dropdown-item"
                                            :class="isActive('{{ $badgesPath }}') ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                                            Badge
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('buttons') }}" class="menu-dropdown-item"
                                            :class="isActive('{{ $buttonsPath }}') ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                                            Buttons
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('images') }}" class="menu-dropdown-item"
                                            :class="isActive('{{ $imagesPath }}') ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                                            Images
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('videos') }}" class="menu-dropdown-item"
                                            :class="isActive('{{ $videosPath }}') ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                                            Videos
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <button @click="toggleSubmenu('menu-auth')" class="menu-item group w-full"
                                :class="[isSubmenuOpen('menu-auth') ? 'menu-item-active' : 'menu-item-inactive', !$store.sidebar.isExpanded && !$store.sidebar.isHovered ? 'xl:justify-center' : 'xl:justify-start']">
                                <span :class="isSubmenuOpen('menu-auth') ? 'menu-item-icon-active' : 'menu-item-icon-inactive'">
                                    {!! IconsHelper::icon('authentication') !!}
                                </span>
                                <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen" class="menu-item-text flex items-center gap-2">
                                    Authentication
                                </span>
                                <span x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen"
                                    class="ml-auto rtl:ml-0 rtl:mr-auto w-5 h-5 transition-transform duration-200"
                                    :class="{ 'rotate-180 text-brand-500': isSubmenuOpen('menu-auth') }">
                                    {!! IconsHelper::icon('chevron-down', 'w-5 h-5') !!}
                                </span>
                            </button>
                            <div x-show="isSubmenuOpen('menu-auth') && ($store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen)">
                                <ul class="mt-2 space-y-1 ml-9 rtl:ml-0 rtl:mr-9">
                                    <li>
                                        <a href="{{ route('signin') }}" class="menu-dropdown-item"
                                            :class="isActive('{{ $signinPath }}') ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                                            Sign In
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('signup') }}" class="menu-dropdown-item"
                                            :class="isActive('{{ $signupPath }}') ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                                            Sign Up
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Sidebar Widget -->
        <div x-data x-show="$store.sidebar.isExpanded || $store.sidebar.isHovered || $store.sidebar.isMobileOpen" x-transition class="mt-auto">
            @include('layouts.sidebar-widget')
        </div>
    </div>
</aside>

<!-- Mobile Overlay -->
<div x-show="$store.sidebar.isMobileOpen" @click="$store.sidebar.setMobileOpen(false)"
    class="fixed z-50 h-screen w-full bg-gray-900/50"></div>
