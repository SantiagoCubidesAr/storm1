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
            <div class="container">
                <div class="row">
                    @foreach($administrators as $administrator)
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="row g-0 align-items-center">
                                <div class="col-md-4 d-flex justify-content-center align-items-center">
                                    <img class="rounded-circle img-fluid"
                                        src="{{ url('images/' . $administrator->photo) }}"
                                        alt="Avatar of {{ $administrator->fullname }}"
                                        style="width: 120px; height: 120px; object-fit: cover;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title text-center">{{ $administrator->fullname }}</h5>
                                        <p class="card-text text-center">
                                            Estado: <span class="badge bg-label-primary">{{ $administrator->status->status }}</span>
                                        </p>
                                        <div class="dropdown text-center">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ url('administrators/' . $administrator->id) }}">
                                                    <i class="bx bx-show me-1"></i> Ver
                                                </a>
                                                <a class="dropdown-item" href="{{ url('administrators/' . $administrator->id . '/edit') }}">
                                                    <i class="bx bx-edit-alt me-1"></i> Actualizar
                                                </a>
                                                <a class="dropdown-item delete" href="javascript:;"
                                                    data-fullname="{{ $administrator->fullname }}">
                                                    <i class="bx bx-trash me-1"></i> Eliminar
                                                </a>
                                                <form action="{{ url('administrators/' . $administrator->id) }}" method="post" style="display: none">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
    <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
@include('partials/scripts')