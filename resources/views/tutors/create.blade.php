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

        <h5 class="card-header">Crear Tutor</h5>

        <div class="card-body">
            <form id="formAuthentication" class="mb-3" action="{{ route('tutors.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(count($errors->all()) > 0)
                @foreach($errors->all() as $message)
                <li>{{$message}}</li>
                @endforeach
                @endif
                <div class="row">
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="{{ url('images/no-image.png') }}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Subir foto</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input type="file" id="upload" class="account-file-input" hidden name="photo" accept="image/*" />
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="timeZones" class="form-label">Rol</label>
                        <select id="timeZones" class="select2 form-select" name="role_id">
                            <option value="4">Tutor</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="timeZones" class="form-label">Estado</label>
                        <select id="timeZones" class="select2 form-select" name="id_status">
                            @foreach($status as $status)"
                            <option value="{{ $status->id }}">{{ $status->status }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="firstName" class="form-label">Full Name</label>
                        <input class="form-control" type="text" id="firstName" name="fullname">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="timeZones" class="form-label">Genero</label>
                        <select id="timeZones" class="select2 form-select" name="id_gender">
                            @foreach($genders as $gender)"
                            <option value="{{ $gender->id }}">{{ $gender->gender }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="phoneNumber">Phone Number</label>
                        <div class="input-group input-group-merge">
                            <input type="number" id="phoneNumber" name="phone" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="state" class="form-label">Email</label>
                        <input class="form-control" type="email" id="state" name="email">
                    </div>
                    <div class="mb-3 col-md-6 form-password-toggle">
                        <label class="form-label" for="password">Contraseña</label>
                        <div class="input-group input-group-merge">
                            <input
                                type="password"
                                id="password"
                                class="form-control"
                                name="password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password" />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                    </div>
                    <div class="mb-3 col-md-6 form-password-toggle">
                        <label class="form-label" for="password">Verificar Contraseña</label>
                        <div class="input-group input-group-merge">
                            <input
                                type="password"
                                id="password"
                                class="form-control"
                                name="password_confirmation"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password" />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Añadir Tutor</button>
                        <a href="{{ url('tutors')}}" class="btn btn-outline-secondary">Cancelar</a>
                    </div>
                </div>
            </form>


            <!-- / Content -->

            <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
        @include('partials/scripts')
