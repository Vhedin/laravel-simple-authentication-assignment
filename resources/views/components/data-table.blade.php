<div class="table-responsive">
    {{ $dataTable->table() }}
</div>

@push('lib-styles')
    <link rel="stylesheet" href="{{ asset('nanopkg-assets/vendor/yajra-laravel-datatables/assets/datatables.css') }}">
@endpush
@push('css')
    <link rel="stylesheet" href="{{ asset('nanopkg-assets/css/data-table.min.css') }}">
    <style>

    </style>
@endpush
@push('lib-scripts')
    <script src="{{ asset('nanopkg-assets/vendor/yajra-laravel-datatables/assets/datatables.js') }}"></script>
@endpush

@push('js')
    {{ $dataTable->scripts() }}
@endpush
