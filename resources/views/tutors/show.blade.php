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

        <h5 class="card-header">Tutor Details</h5>
        <div class="card-body">
            <div class="row">
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img src="{{ url('images/'. $tutor->user->photo) }}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                    </div>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="firstName" class="form-label">Roles</label>
                    <input class="form-control" type="text" id="firstName" name="fullname" value="{{ optional($tutor->user->roles->first())->name ?? 'No Role' }}" readonly>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="firstName" class="form-label">Full Name</label>
                    <input class="form-control" type="text" id="firstName" name="fullname" value="{{ $tutor->user->fullname ?? 'N/A' }}" readonly>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="lastName" class="form-label">Estado</label>
                    <input class="form-control" type="text" name="status" id="lastName" value="{{ optional($tutor->user->status)->status ?? 'Unknown' }}" readonly>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="organization" class="form-label">Gender</label>
                    <input type="text" class="form-control" id="organization" name="gender" value="{{ optional($tutor->user->genders)->gender ?? 'Unknown' }}" readonly>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="phoneNumber">Phone Number</label>
                    <div class="input-group input-group-merge">
                        <input type="text" id="phoneNumber" name="phone" class="form-control" value="{{ $tutor->user->phone }}" readonly>
                    </div>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ $tutor->user->address }}" readonly>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="state" class="form-label">Email</label>
                    <input class="form-control" type="email" id="state" name="email" value="{{ $tutor->user->email }}" readonly>
                </div>
                <div class="mt-2">
                    <a href="{{ url('tutors')}}" class="btn btn-outline-secondary">Atras</a>
                </div>
            </div>


            <!-- / Content -->

            <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
        @include('partials/scripts')
