    <a href="{{ route('users.edit', $user) }}">
        <button type="button" class="btn btn-outline-info btn-rounded btn-icon">
            <i class="mdi mdi-pencil"></i>
        </button>
    </a>

    <a href="{{ route('users.destroy', $user) }}">
        <button type="button" class="btn btn-outline-danger btn-rounded btn-icon">
            <i class="mdi mdi-delete"></i>
        </button>
    </a>