<!-- All Javascript Here -->

<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('assets/js/addJob.js') }}"></script>
<script src="{{ asset('assets/js/datatableInit.js') }}"></script>
{{-- Active Sidenav Script --}}
<script>
    $(document).ready(function () {
        var currentUrl = window.location.href;
        $('.menu-link').each(function () {
            var linkUrl = $(this).attr('href');
            if (currentUrl === linkUrl) {
                $(this).addClass('active');
                $(this).closest('.menu-accordion').addClass('show');
            }
        });
    });
</script>
