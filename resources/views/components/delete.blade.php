<form action="" method="POST" id="delete-form" style="display: none">
    @csrf
    @method('Delete')
</form>
<script src="{{ asset('admin-assets/js/delete.min.js') }}"></script>
