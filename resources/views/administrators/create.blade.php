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

        <h5 class="card-header">Studnet Details</h5>

        <div class="card-body">
            <div class="row">
                <form id="formAuthentication" class="mb-3" action="{{ route('administrators.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(count($errors->all()) > 0)
                    @foreach($errors->all() as $message)
                    <li>{{$message}}</li>
                    @endforeach
                    @endif
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img
                                src="{{ asset('images/no-photo.png') }}"
                                alt="user-avatar"
                                class="d-block rounded"
                                height="100"
                                width="100"
                                id="uploadedAvatar" />
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Subir foto</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input
                                        type="file"
                                        id="upload"
                                        class="account-file-input"
                                        hidden
                                        name="photo"
                                        accept="image/*" />
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="timeZones" class="form-label">Rol</label>
                        <select id="timeZones" class="select2 form-select" name="role">
                            <option value="Conductor">Conductor</option>
                            <option value="Estudiante">Estudiante</option>
                            <option value="Tutor">Tutor</option>
                            <option value="Administrador">Administrador</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="timeZones" class="form-label">Genero</label>
                        <select id="timeZones" class="select2 form-select" name="gender">
                            <option value="male">Masculino</option>
                            <option value="female">Femenino</option>
                            <option value="other">Otro</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <div class="mb-3">
                            <label for="username" class="form-label">Nombre</label>
                            <input
                                type="text"
                                class="form-control"
                                id="username"
                                name="fullname"
                                placeholder="Enter your username"
                                autofocus />
                        </div>
                        <label for="email" class="form-label">Telefono</label>
                        <input type="text" class="form-control" id="email" name="phone" placeholder="Enter your email" />
                        <label for="email" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="email" name="address" placeholder="Enter your email" />
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" />
                    </div>
                    <div class="mb-3 form-password-toggle">
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
                    <div class="mb-3 form-password-toggle">
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

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                            <label class="form-check-label" for="terms-conditions">
                                I agree to
                                <a href="javascript:void(0);">privacy policy & terms</a>
                            </label>
                        </div>
                    </div>
                    <button class="btn btn-primary d-grid w-100">Agregar Administrador</button>
                </form>
            </div>


            <!-- / Content -->

            <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
        @include('partials/scripts')
