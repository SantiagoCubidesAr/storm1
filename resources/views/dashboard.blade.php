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
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Usuarios /</span> Administradores</h4>

            <div class="d-flex justify-content-center mb-3">
                <a href="{{ url('administrators/create') }}" class="btn btn-primary">+ Add Administrator</a>
            </div>
            <!-- Basic Bootstrap Table -->
            <div class="card">
                <h5 class="card-header">Administradores</h5>
                <div class="table-responsive text-nowrap vh-100">
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
                            @foreach ($administrators as $administrator)
                            <tr>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$administrator->fullname}}</strong></td>
                                <td>
                                    <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="" data-bs-original-title="Christina Parker">
                                            <img src="{{ url('images/' . $administrator->photo)  }}" alt="Avatar" class="rounded-circle">
                                        </li>
                                    </ul>
                                </td>
                                <td><span class="badge bg-label-primary me-1">{{$administrator->status->status}}</span></td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ url('administrators/' . $administrator->id) }}"><i class="bx bx-show me-1"></i> Ver</a>
                                            <a class="dropdown-item" href="{{ url('administrators/' . $administrator->id . '/edit') }}"><i class="bx bx-edit-alt me-1"></i> Actualizar</a>
                                            <a class="dropdown-item delete" href="javascript:;"><i class="bx bx-trash me-1" data-fullname="{{ $administrator->fullname }}"></i>Eliminar</a>
                                            <form action="{{ url('administrators/' . $administrator->id) }}" method="post" style="display: none">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- / Content -->

        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
    @include('partials/scripts')
