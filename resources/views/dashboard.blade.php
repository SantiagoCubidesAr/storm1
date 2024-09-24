@include('partials/head')
<!-- Menu -->

@include('partials/aside')
<!-- / Menu -->

<!-- Layout container -->
<div class="layout-page">
    <!-- Navbar -->

    @include('partials/nav')

    <!-- / Navbar -->

    <!-- Content wrapper -->
    <div class="content-wrapper">

        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Usuarios /</span> Estudiantes</h4>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <h5 class="card-header">Estudiantes</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Foto</th>
                                <th>Estado</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($users as $user)
                            <tr>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$user->fullname}}</strong></td>
                                <td>
                                    <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="" data-bs-original-title="Christina Parker">
                                            <img src="{{ asset('images'). '/' . $user->photo }}" alt="Avatar" class="rounded-circle">
                                        </li>
                                    </ul>
                                </td>
                                <td><span class="badge bg-label-primary me-1">Activo</span></td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-show me-1"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Actualizar</a>
                                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i>Eliminar</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->

        </div>

        <!-- / Content -->

        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
    @include('partials/scripts')