<!--Global script(used by all pages)-->
<script src="{{ asset('admin-assets/vendor/jQuery/jquery.min.js') }}"></script>
<script src="{{ asset('admin-assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
@stack('lib-scripts')
<script src="{{ asset('nanopkg-assets/vendor/highlight/highlight.min.js') }}"></script>
<script src="{{ asset('admin-assets/vendor/metisMenu/metisMenu.min.js') }}"></script>
<script src="{{ asset('admin-assets/vendor/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('nanopkg-assets/vendor/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('nanopkg-assets/vendor/fontawesome-free-6.3.0-web/js/all.min.js') }}"></script>
<script src="{{ asset('nanopkg-assets/vendor/toastr/build/toastr.min.js') }}"></script>
<script src="{{ asset('nanopkg-assets/vendor/axios/dist/axios.min.js') }}"></script>
<script src="{{ asset('nanopkg-assets/vendor/jquery-validation-1.19.5/jquery.validate.min.js') }}"></script>
<script src="{{ asset('nanopkg-assets/js/axios.init.min.js') }}"></script>
<script src="{{ asset('nanopkg-assets/js/arrow-hidden.min.js') }}"></script>
<script src="{{ asset('nanopkg-assets/js/img-src.min.js') }}"></script>
<script src="{{ asset('nanopkg-assets/js/delete.min.js') }}"></script>
<script src="{{ asset('nanopkg-assets/js/user-status-update.min.js') }}"></script>
<script src="{{ asset('nanopkg-assets/js/main.js') }}"></script>

<!--Page Scripts(used by all page)-->
<script src="{{ asset('admin-assets/js/sidebar.min.js') }}"></script>
@stack('js')
