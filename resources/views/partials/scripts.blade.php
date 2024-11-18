</div>
<!-- / Layout page -->
</div>

<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->

<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

<script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('assets/js/main.js') }}"></script>

<!-- Page JS -->
<script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
<script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.js') }}"></script>

<script>
    $('.delete').on('click', function() {
            var $this = $(this);
            var $fullname = $this.attr('data-fullname')

            Swal.fire({
                title: "Are you sure?",
                text: "Desea eliminar a:" + $fullname,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $this.next().submit()
                }
            });
        })

        $(document).ready(function () {
        // Extraer el modelo de la URL actual
        let path = window.location.pathname.split('/');
        let model = path[1]; // Obtener la primera parte de la URL (e.g., 'administrators')

        // Verificar que el modelo esté en la lista permitida
        const validModels = ['administrators', 'students', 'drivers', 'tutors'];
        if (!validModels.includes(model)) {
            model = 'administrators'; // Valor por defecto si no se encuentra un modelo válido
        }

        // Manejar el evento keyup para la búsqueda
        $('body').on('keyup', '#qsearch', function (e) {
            e.preventDefault();
            let query = $(this).val();
            let token = $('input[name=_token]').val();

            $.post(`/${model}/search`, {
                    q: query,
                    _token: token
                },
                function (data) {
                    $('.card').html(data);
                }
            );
        });
    });
</script>
</body>

</html>
