<x-app-layout>
    <x-card>
        <x-slot name='actions'>
            <a href="{{ route(config('theme.rprefix') . '.index') }}" class="btn btn-success btn-sm"><i
                    class="fa fa-list"></i>&nbsp;{{ __('User List') }}</a>
        </x-slot>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Created At') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($collection as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->created_at->diffForHumans() }}</td>
                                    <td>
                                        {{-- restore --}}
                                        <form action="{{ route(config('theme.rprefix') . '.restore', $item->id) }}"
                                            method="post">
                                            @csrf
                                            <button title="{{ __('Restore') }}" type="submit"
                                                onclick="return confirm('Are you sure to restore?')"
                                                class="btn btn-success btn-sm my-1"><i class="fa fa-undo"></i></button>
                                        </form>
                                        {{-- permanent delete --}}
                                        <button title="{{ __('Permanent Delete') }}" type="button"
                                            class="btn btn-danger btn-sm"
                                            onclick="delete_modal('{{ route(config('theme.rprefix') . '.destroy', [$item->id, 'force_delete' => true]) }}')"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">{{ __('No Data Found') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div>
                        {{ $collection->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </x-card>

</x-app-layout>
