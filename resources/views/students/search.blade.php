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
                @foreach ($students as $student)
                <tr>
                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$student->fullname}}</strong></td>
                    <td>
                        <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="" data-bs-original-title="Christina Parker">
                                <img src="{{ url('images/' . $student->photo)  }}" alt="Avatar" class="rounded-circle">
                            </li>
                        </ul>
                    </td>
                    <td><span class="badge bg-label-primary me-1">{{$student->status->status}}</span></td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ url('students/' . $student->id) }}"><i class="bx bx-show me-1"></i> Ver</a>
                                <a class="dropdown-item" href="{{ url('students/' . $student->id . '/edit') }}"><i class="bx bx-edit-alt me-1"></i> Actualizar</a>
                                <a class="dropdown-item delete" href="javascript:;"><i class="bx bx-trash me-1" data-fullname="{{ $student->fullname }}"></i>Eliminar</a>
                                <form action="{{ url('students/' . $student->id) }}" method="post" style="display: none">
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
