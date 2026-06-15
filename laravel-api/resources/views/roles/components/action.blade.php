    
    <a href="{{ route('roles.show', $role) }}">
        <button type="button" class="btn btn-outline-success btn-rounded btn-icon">
            <i class="mdi mdi-eye"></i>
        </button>
    </a>

    <a href="{{ route('roles.edit', $role) }}">
        <button type="button" class="btn btn-outline-info btn-rounded btn-icon">
            <i class="mdi mdi-pencil"></i>
        </button>
    </a>
    @if ($role->users->count() == 0)
        <form class="d-inline" id="deleteForm{{ $role->id }}"
              action="{{ route('roles.destroy', $role) }}" method="post">
            @csrf
            @method('DELETE')
            @php $name = str_replace("'", "\'", str_replace('"', '\"', $role->name)) @endphp
            <a title="Supprimer ce rôle"
                onclick="modalAlertDelete('deleteForm{{ $role->id }}', 'Suppression d\'un rôle', 'rôle', '{{ $name }}')"
                role="button">
                <button type="button" class="btn btn-outline-danger btn-rounded btn-icon">
                    <i class="mdi mdi-delete"></i>
                </button>
            </a>
        </form>
    @endif

