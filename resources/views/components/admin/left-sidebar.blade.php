    <nav class="sidebar sidebar-bunker sidebar-sticky">
        <div class="sidebar-header">
            <a href="{{ route('home') }}" class="sidebar-brand">
                <img class="sidebar-logo-lg" src="{{ asset('admin-assets/img/logo-light.png') }}">
                <img class="sidebar-logo-sm" src="{{ asset('admin-assets/img/favicon.png') }}">
            </a>
        </div>

        <!--/.sidebar header-->
        <div class="profile-element d-block align-items-center flex-shrink-0">
            <div class="avatar online mb-2">
                <img src="{{ auth()->user()->profile_photo_url }}" class="img-fluid rounded-circle">
            </div>
            <div class="profile-text text-center">
                <h6 class="m-0">{{ auth()->user()->name }}</h6>
            </div>
        </div>

        <!--/.sidebar header-->
        <div class="sidebar-body">
            <nav class="sidebar-nav">
                <ul class="metismenu">
                    <x-admin.multi-nav>
                        <x-slot name="title">
                            <i class="typcn typcn-group"></i> {{ __('Users Mangment') }}
                        </x-slot>
                        <x-admin.nav-link href="{{ route('user.index') }}">
                            {{ __('User List') }}
                        </x-admin.nav-link>
                        <x-admin.nav-link href="{{ route('user.trash') }}">
                            {{ __('User Trash List') }}
                        </x-admin.nav-link>
                        <x-admin.nav-link href="{{ route('user.create') }}">
                            {{ __('Create User') }}
                        </x-admin.nav-link>
                    </x-admin.multi-nav>
                </ul>
            </nav>
            <div class="mt-auto p-3 sidebar-logout">
                {{-- <x-logout>
                    <span class="btn btn-success w-100"> <img class="me-2"
                            src="{{ asset('admin-assets/img/logout.png') }}"><span>{{ __('Logout') }}</span></span>
                </x-logout> --}}
            </div>
        </div>
        <!-- sidebar-body -->
    </nav>
