<x-app-layout>
    <x-card>
        <x-slot name='actions'>
            <a href="{{ route(config('theme.rprefix') . '.index') }}" class="btn btn-success btn-sm"><i
                    class="fa fa-list"></i>&nbsp;{{ __('User List') }}</a>
        </x-slot>
        <div class="row">
            <div class="col-sm-12">
                <form enctype="multipart/form-data" action="{{ route(config('theme.rprefix') . '.profile.edit') }}"
                    method="POST" class="needs-validation" enctype="multipart/form-data">
                    @csrf
                    @isset($item)
                        @method('PUT')
                    @endisset

                    <fieldset class="mb-5 py-3 px-4 ">
                        <legend>{{ __('Account Info') }}:</legend>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group pt-1 pb-1">
                                    <label for="name" class="font-black">{{ __('Name') }}</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        placeholder="{{ __('Enter Name') }}"
                                        value="{{ isset($item) ? $item->name : old('name') }}" required>
                                    @error('name')
                                        <p class="text-danger pt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group pt-1 pb-1">
                                    <label for="email" class="font-black">{{ __('Email') }}</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="{{ __('Enter Email') }}"
                                        value="{{ isset($item) ? $item->email : old('email') }}" required>
                                    @error('email')
                                        <p class="text-danger pt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 pt-1 pb-1">
                                <div class="form-group">
                                    <label for="password" class="font-black">{{ __('Password') }}</label>
                                    <input type="password" class="form-control" name="password" id="password"
                                        placeholder="{{ __('Enter Password') }}" {{ isset($item) ? '' : 'required' }}
                                        autocomplete="new-password">
                                    @error('password')
                                        <p class="text-danger pt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 pt-1 pb-1">
                                <div class="form-group">
                                    <label for="password_confirmation"
                                        class="font-black">{{ __('Confirm Password') }}</label>
                                    <input type="password" class="form-control" name="password_confirmation"
                                        id="password_confirmation" placeholder="{{ __('Retype Password') }}"
                                        {{ isset($item) ? '' : 'required' }} autocomplete="new-password">
                                    @error('password_confirmation')
                                        <p class="text-danger pt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 pt-1 pb-1">
                                <div class="form-group">
                                    <label for="avatar" class="font-black">{{ __('Avatar') }}</label>
                                    <input type="file" class="form-control" name="avatar" id="avatar"
                                        onchange="get_img_url(this, '#avatar_image');"
                                        placeholder="{{ __('Select avatar image') }}">
                                    <img id="avatar_image" src="{{ isset($item) ? $item->profile_photo_url : '' }}"
                                        width="120px" class="mt-1">
                                    @error('avatar')
                                        <p class="text-danger pt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="mb-5 py-3 px-4 ">
                        <legend>{{ __('Address') }}:</legend>
                        <div id="address-container">
                            @if (isset($item) && count($item->addresses) > 0)
                                @foreach ($item->addresses as $index => $address)
                                    <div class="row">
                                        <div class="col-md-3 form-group pt-1 pb-1">
                                            <label for="country-{{ $index }}"
                                                class="font-black text-capitalize">{{ __('Country') }}</label>
                                            <input type="text" class="form-control"
                                                name="addresses[{{ $index }}][country]"
                                                id="country-{{ $index }}"
                                                placeholder="{{ __('Enter Country Name') }}"
                                                value="{{ $address->country }}" required>
                                        </div>
                                        <div class="col-md-3 form-group pt-1 pb-1">
                                            <label for="city-{{ $index }}"
                                                class="font-black text-capitalize">{{ __('City') }}</label>
                                            <input type="text" class="form-control"
                                                name="addresses[{{ $index }}][city]"
                                                id="city-{{ $index }}"
                                                placeholder="{{ __('Enter City Name') }}" value="{{ $address->city }}"
                                                required>
                                        </div>
                                        <div class="col-md-4 form-group pt-1 pb-1">
                                            <label for="address-{{ $index }}"
                                                class="font-black text-capitalize">{{ __('address') }}</label>
                                            <textarea type="text" class="form-control" name="addresses[{{ $index }}][address]"
                                                id="address-{{ $index }}" placeholder="{{ __('Enter Address Name') }}" rows="1" required>{{ $address->address }}</textarea>
                                        </div>
                                        <div class="col-md-2 form-group pt-2 pb-1">
                                            @if ($index == 0)
                                                <button type="button" class="btn btn-success btn-sm mt-4"
                                                    id="add_address" onclick="addNewAddress()">
                                                    <i class="fa fa-plus"></i>
                                                @else
                                                    <button type="button" class="btn btn-danger btn-sm mt-4"
                                                        onclick="removeAddress(this)">
                                                        <i class="fa fa-minus "></i>
                                                    </button>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="row">
                                    <div class="col-md-3 form-group pt-1 pb-1">
                                        <label for="country-0" class="font-black text-capitalize">Country</label>
                                        <input type="text" class="form-control" name="addresses[0][country]"
                                            id="country-0" placeholder="Enter Country Name" value="" required>
                                    </div>
                                    <div class="col-md-3 form-group pt-1 pb-1">
                                        <label for="city-0" class="font-black text-capitalize">City</label>
                                        <input type="text" class="form-control" name="addresses[0][city]"
                                            id="city-0" placeholder="Enter City Name" value="" required>
                                    </div>
                                    <div class="col-md-4 form-group pt-1 pb-1">
                                        <label for="address-0" class="font-black text-capitalize">address</label>
                                        <textarea type="text" class="form-control" name="addresses[0][address]" id="address-0"
                                            placeholder="Enter Address Name" rows="1" required></textarea>
                                    </div>
                                    <div class="col-md-2 form-group pt-2 pb-1">
                                        <button type="button" class="btn btn-success btn-sm mt-4" id="add_address"
                                            onclick="addNewAddress()">
                                            <i class="fa fa-plus "></i>
                                        </button>
                                    </div>
                                </div>
                            @endif

                        </div>

                    </fieldset>
                    <div class="form-group pt-1 pb-1 text-center">
                        <button type="submit" class="btn btn-success btn-round">{{ __('Save') }}</button>
                    </div>

                </form>
            </div>
        </div>
    </x-card>
    @push('js')
        <script>
            // Add New Address
            function addNewAddress() {
                let address_container = document.getElementById('address-container');
                let index = address_container.children.length;
                let new_address = `
                    <div class="row">
                        <div class="col-md-3 form-group pt-1 pb-1">
                            <label for="country-${index}" class="font-black text-capitalize">Country</label>
                            <input type="text" class="form-control" name="addresses[${index}][country]" id="country-${index}" placeholder="Enter Country Name" value="" required>
                        </div>
                        <div class="col-md-3 form-group pt-1 pb-1">
                            <label for="city-${index}" class="font-black text-capitalize">City</label>
                            <input type="text" class="form-control" name="addresses[${index}][city]" id="city-${index}" placeholder="Enter City Name" value="" required>
                        </div>
                        <div class="col-md-4 form-group pt-1 pb-1">
                            <label for="address-${index}" class="font-black text-capitalize">address</label>
                            <textarea type="text" class="form-control" name="addresses[${index}][address]" id="address-${index}" placeholder="Enter Address Name" rows="1" required></textarea>
                        </div>
                        <div class="col-md-2 form-group pt-2 pb-1">
                            <button type="button" class="btn btn-danger btn-sm mt-4" onclick="removeAddress(this)">
                                <i class="fa fa-minus "></i>
                            </button>
                        </div>
                    </div>
                `;
                address_container.insertAdjacentHTML('beforeend', new_address);
            }

            // Remove Address
            function removeAddress(e) {
                e.closest('.row').remove();
            }
        </script>
    @endpush
</x-app-layout>
