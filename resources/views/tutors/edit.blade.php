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

        <h5 class="card-header">Actualizar Tutor</h5>

        <div class="card-body">
            <form action="{{ url('tutors/' .$tutor->user->id)}}" id="formAccountSettings" method="POST" enctype="multipart/form-data">
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
                                src="{{ url('images/' . $tutor->user->photo) }}"
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
                                    <input type="hidden" name="originphoto" value="{{ $tutor->user->photo }}">
                                </label>
                                <p class="text-muted mb-0">Permite JPG, GIF o PNG. Tamaño Maximo de 800K</p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="timeZones" class="form-label">Rol</label>
                        <select id="timeZones" class="select2 form-select" name="name">
                            @foreach($roles as $role)"
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                    <label for="timeZones" class="form-label">Estado</label>
                        <select id="timeZones" class="select2 form-select" name="id_status">
                            @foreach($status as $status)
                            <option value="{{ $status->id }}">{{ $status->status }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="firstName" class="form-label">Full Name</label>
                        <input class="form-control" type="text" id="firstName" name="fullname" value="{{ old('fullname', $tutor->user->fullname) }}">
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
                            <input type="text" id="phoneNumber" name="phone" class="form-control" value="{{ old('phone', $tutor->user->phone) }}">
                        </div>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $tutor->user->address) }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input class="form-control" type="email" id="email" name="email" value="{{ old('email', $tutor->user->email) }}">
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Guardar Cambios</button>
                        <a href="{{ url('tutors')}}" class="btn btn-outline-secondary">Cancelar</a>
                    </div>
            </form>
        </div>


        <!-- / Content -->

        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
    @include('partials/scripts')
