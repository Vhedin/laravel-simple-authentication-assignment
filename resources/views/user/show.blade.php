<x-app-layout>
    <x-card>
        <x-slot name='actions'>
            <a href="{{ route(config('theme.rprefix') . '.index') }}" class="btn btn-success btn-sm"><i
                    class="fa fa-list"></i>&nbsp;{{ __('User List') }}</a>
        </x-slot>
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    {{--  --}}
                    <div class="col-md-12 text-center">
                        <img id="avatar_image" src="{{ isset($item) ? $item->profile_photo_url : '' }}" width="120px"
                            class="my-2">
                        <div>
                            <h5 for="name">
                                {{ $item->name }}
                            </h5>
                            <h5>
                                {{ $item->email }}
                            </h5>
                        </div>
                    </div>
                </div>
                <h4 class="fw-bold">{{ __('Address') }}:</h4>
                <hr>
                <div class="row">
                    @forelse ($item->addresses as $index => $address)
                        <div class="col-md-2 ">
                            <div class="border my-2  p-2 ">
                                <p>
                                    <span class="fw-bold">Country: </span>
                                    <span class="text-capitalize">{{ $address->country }}</span>
                                </p>
                                <p>
                                    <span class="fw-bold">City: </span>
                                    <span class="text-capitalize">{{ $address->city }}</span>
                                </p>
                                <p>
                                    <span class="fw-bold">Address: </span>
                                    <span class="text-capitalize">{{ $address->address }}</span>
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-12">
                            <div class="alert alert-warning">
                                {{ __('No address found') }}
                            </div>
                        </div>
                    @endforelse

                </div>
            </div>
        </div>
    </x-card>
</x-app-layout>
