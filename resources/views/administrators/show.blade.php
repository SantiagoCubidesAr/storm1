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

        <h5 class="card-header">Detalles Administrador</h5>
        <div class="card-body">
            <div class="row">
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img src="{{ url('images/'. $administrator->user->photo) }}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                    </div>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="firstName" class="form-label">Roles</label>
                    <input class="form-control" type="text" id="firstName" name="fullname" value="{{ optional($administrator->user->roles->first())->name ?? 'No Role' }}" readonly>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="firstName" class="form-label">Full Name</label>
                    <input class="form-control" type="text" id="firstName" name="fullname" value="{{ $administrator->user->fullname ?? 'N/A' }}" readonly>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="lastName" class="form-label">Estado</label>
                    <input class="form-control" type="text" name="status" id="lastName" value="{{ optional($administrator->user->status)->status ?? 'Unknown' }}" readonly>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="organization" class="form-label">Gender</label>
                    <input type="text" class="form-control" id="organization" name="gender" value="{{ optional($administrator->user->genders)->gender ?? 'Unknown' }}" readonly>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="phoneNumber">Phone Number</label>
                    <div class="input-group input-group-merge">
                        <input type="text" id="phoneNumber" name="phone" class="form-control" value="{{ $administrator->user->phone }}" readonly>
                    </div>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ $administrator->user->address }}" readonly>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="state" class="form-label">Email</label>
                    <input class="form-control" type="email" id="state" name="email" value="{{ $administrator->user->email }}" readonly>
                </div>
                <div class="mt-2">
                    <a href="{{ url('dashboard')}}" class="btn btn-outline-secondary">Atras</a>
                </div>
            </div>


            <!-- / Content -->

            <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
        @include('partials/scripts')
