    
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

    <a href="{{ route('roles.destroy', $role) }}">
        <button type="button" class="btn btn-outline-danger btn-rounded btn-icon">
            <i class="mdi mdi-delete"></i>
        </button>
    </a>