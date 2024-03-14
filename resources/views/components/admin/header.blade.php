<nav class="navbar-custom-menu navbar navbar-expand-lg m-0">
    <div class="sidebar-toggle-icon" id="sidebarCollapse">
        sidebar toggle<span></span>
    </div>

    <div class="navbar-icon d-flex">
        <ul class="navbar-nav flex-row align-items-center">
            <!--/.dropdown-->
            <li class="nav-item dropdown notification user-header-menu">
                <a class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown"
                    style="padding: 0 !important;" aria-expanded="false">
                    <img class="img-fluid" src="{{ auth()->user()->profile_photo_url }}">
                </a>
                <div class="dropdown-menu">
                    <div class="dropdown-header d-sm-none">
                        <a href="" class="header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                    </div>
                    <div class="user-header">
                        <div class="img-user">
                            <img src="{{ auth()->user()->profile_photo_url }}">
                        </div>
                        <!-- img-user -->
                        <h6>{{ auth()->user()->name }}</h6>
                        <span>{{ auth()->user()->email }}</span>
                    </div>
                    <!-- user-header -->
                    <a href="{{ route('user-profile-information.index') }}" class="dropdown-item">
                        <i class="typcn typcn-user-outline"></i>
                        {{ __('My Profile') }}
                    </a>
                    <a href="{{ route('user-profile-information.edit') }}" class="dropdown-item">
                        <i class="typcn typcn-edit"></i>
                        {{ __('Edit Profile') }}
                    </a>
                    <x-logout class="dropdown-item">
                        <span class="text-black">
                            <i class="typcn typcn-key-outline"></i>
                            {{ __('Sign Out') }}

                    </x-logout>
                </div>
                <!--/.dropdown-menu -->
            </li>
        </ul>
        <!--/.navbar nav-->
        <div class="nav-clock">
            <div class="time">
                <span class="time-hours"></span>
                <span class="time-min"></span>
                <span class="time-sec"></span>
            </div>
        </div>
        <!-- nav-clock -->
    </div>
</nav>
