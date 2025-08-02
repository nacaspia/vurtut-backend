<!-- footer start -->
<div class="footer">
    <p>Copyright© <script>document.write(new Date().getFullYear())</script> All Rights Reserved By <span class="text-primary">Digiboard</span></p>
</div>
<!-- footer end -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script src="{{ asset('admin/assets/vendor/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/js/apexcharts.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/js/moment.min.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/js/daterangepicker.js') }}"></script>
<script src="{{ asset('admin/assets/vendor/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/dashboard.js') }}"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>

<script src="{{ asset('admin/assets/js/main.js') }}"></script>
<!-- for demo purpose -->
<script>
    var rtlReady = $('html').attr('dir', 'ltr');
    if (rtlReady !== undefined) {
        localStorage.setItem('layoutDirection', 'ltr');
    }
</script>
@yield('admin.js')
<!-- for demo purpose -->
</body>
</html>
