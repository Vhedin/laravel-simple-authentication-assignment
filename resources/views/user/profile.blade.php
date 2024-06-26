<x-app-layout>
    <div class="tile">

        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-4">
                                <div>
                                    <h6 class="fs-17 fw-semi-bold mb-0">{{ __('Profile') }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <div class="media m-1 ">
                                <div class="align-left p-1">
                                    <a href="#" class="profile-image">
                                        <img src="{{ auth()->user()->profile_photo_url }}"
                                            class="avatar avatar-xl rounded-circle img-border height-100"
                                            alt="card image">
                                    </a>
                                </div>
                                <div class="media-body ms-3 mt-1">
                                    <h3 class="font-large-1 white">
                                        {{ auth()->user()->name }}
                                    </h3>
                                    <div class="row justify-content-center">
                                        <table class="table table-borderless table-responsive">
                                            <tbody>
                                                <tr>
                                                    <th class="white">
                                                        <i class="fas fa-envelope"></i>
                                                    </th>
                                                    <td class="white text-start">
                                                        {{ auth()->user()->email ?? '---' }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
