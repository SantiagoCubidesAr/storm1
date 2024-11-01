<div class="card">
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
                @foreach ($users as $user)
                @if($user->roles->contains('name', 'Administrador'))
                <tr>
                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$user->fullname}}</strong></td>
                    <td>
                        <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="" data-bs-original-title="Christina Parker">
                                <img src="{{ asset('images'). '/' . $user->photo }}" alt="Avatar" class="rounded-circle">
                            </li>
                        </ul>
                    </td>
                    <td><span class="badge bg-label-primary me-1">{{$user->status->status}}</span></td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <ul class="dropdown-menu z-index-1">
                                <li><a class="dropdown-item" href="{{ url('administrators/' . $user->id) }}"><i class="bx bx-show me-1"></i> Ver</a></li>
                                <li><a class="dropdown-item" href="{{ url('administrators/' . $user->id . '/edit') }}"><i class="bx bx-edit-alt me-1"></i> Actualizar</a></li>
                                <li><a class="dropdown-item delete" href="javascript:;" data-fullname="{{ $user->fullname }}"><i class="bx bx-trash me-1"></i> Eliminar</a></li>
                                <form action="{{ url('administrators/' . $user->id) }}" method="post" style="display: none">
                                    @csrf
                                    @method('delete')
                                </form>
                            </ul>
                        </div>
                    </td>

                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
