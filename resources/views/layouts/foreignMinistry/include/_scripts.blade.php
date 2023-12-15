<!-- All Javascript Here -->

<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
<script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
<script src="{{ asset('assets/js/custom/apps/chat/chat.js') }}"></script>
<script src="{{ asset('assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
<script src="{{ asset('assets/js/custom/utilities/modals/create-app.js') }}"></script>
<script src="{{ asset('assets/js/custom/utilities/modals/users-search.js') }}"></script>
<script src="{{ asset('assets/js/custom/apps/ecommerce/catalog/products.js') }}"></script>
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