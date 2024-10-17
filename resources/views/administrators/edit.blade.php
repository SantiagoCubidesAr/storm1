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

        <h5 class="card-header">Detalles Estudiante</h5>

        <div class="card-body">
            <form action="{{ url('administrators/' .$user->id)}}" id="formAccountSettings" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @if(count($errors->all()) > 0)
                @foreach($errors->all() as $message)
                <li>{{$message}}</li>
                @endforeach
                @endif
                <div class="row">
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img
                                src="{{ asset('images'). '/' . $user->photo }}"
                                alt="user-avatar"
                                class="d-block rounded"
                                height="100"
                                width="100"
                                id="uploadedAvatar" />
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Actualizar Foto</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input
                                        type="file"
                                        id="upload"
                                        class="account-file-input"
                                        name="photo"
                                        hidden
                                        accept="image/png, image/jpeg" />
                                        <input type="hidden" name="originphoto" value="{{ $user->photo }}">
                                </label>
                                <p class="text-muted mb-0">Permite JPG, GIF o PNG. Tamaño Maximo de 800K</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="firstName" class="form-label">Roles</label>
                        <input class="form-control" type="text" id="firstName" name="name" value="{{ old('name', $user->roles->first()->name ) }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="firstName" class="form-label">Estado</label>
                        <input class="form-control" type="text" id="firstName" name="status" value="{{ old('status', $user->status) }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="firstName" class="form-label">Full Name</label>
                        <input class="form-control" type="text" id="firstName" name="fullname" value="{{ old('fullname', $user->fullname) }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="organization" class="form-label">Gender</label>
                        <input type="text" class="form-control" id="organization" name="gender" value="{{ old('gender', $user->gender) }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="phoneNumber">Phone Number</label>
                        <div class="input-group input-group-merge">
                            <input type="text" id="phoneNumber" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                        </div>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $user->address) }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="state" class="form-label">Email</label>
                        <input class="form-control" type="email" id="state" name="email" value="{{ old('email', $user->email) }}">
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Guardar Cambios</button>
                        <button type="reset" class="btn btn-outline-secondary">Cancelar</button>
                    </div>
            </form>
        </div>


        <!-- / Content -->

        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
    @include('partials/scripts')
