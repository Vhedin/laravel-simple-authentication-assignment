<x-app-layout>
    <x-card>
        <x-slot name='actions'>
            <a href="{{ route(config('theme.rprefix') . '.trash') }}" class="btn btn-danger btn-sm"><i
                    class="fa fa-trash"></i>&nbsp;{{ __('View Trash') }}</a>
            <a href="{{ route(config('theme.rprefix') . '.create') }}" class="btn btn-success btn-sm"><i
                    class="fa fa-user-plus"></i>&nbsp;{{ __('Create User') }}</a>
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
                                        <a href="{{ route(config('theme.rprefix') . '.show', $item->id) }}"
                                            class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route(config('theme.rprefix') . '.edit', $item->id) }}"
                                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>

                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="delete_modal('{{ route(config('theme.rprefix') . '.destroy', $item->id) }}')"><i
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
