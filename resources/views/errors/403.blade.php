<x-guest-layout class="bg-white">
    <div class="d-flex align-items-center justify-content-center text-center h-100vh">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                <div class="four_zero_four_bg">
                    <h1 class="fw-bold text-monospace">403</h1>
                </div>
                <div class="contant_box_505">
                    <h3 class="h2">@lang('Forbidden')!</h3>
                    <p><b>403 - @lang('Forbidden'):</b> {{ __("You don't have permission to access on the server.") }}
                    </p>
                </div>
                <div>
                    <a class="btn btn-success mt-3" href="{{ route('home') }}">
                        <i class="typcn typcn-home-outline mr-1"></i>
                        {{ __('Home') }}
                    </a>
                </div>
            </div>
            <div class="col-md-12 mt-5">
                <x-admin.guest-footer class="text-center text-black" />

            </div>
        </div>
    </div>
</x-guest-layout>
