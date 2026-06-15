    <a href="{{ route('users.edit', $user) }}">
        <button type="button" class="btn btn-outline-info btn-rounded btn-icon">
            <i class="mdi mdi-pencil"></i>
        </button>
    </a>

    @can ('user.delete')
        @if (Auth::id() != $user->id)
            <form class="d-inline ms-2" id="deleteForm{{ $user->id }}"
                action="{{ route('users.destroy', $user) }}" method="post">
                @csrf
                @method('DELETE')
                @php $name = str_replace("'", "\'", str_replace('"', '\"', $user->name)) @endphp
                <a title="Supprimer cet utilisateur"
                onclick="modalAlertDelete('deleteForm{{ $user->id }}', 'Suppression d\'un utilisateur', 'utilisateur', '{{ $name }}')"
                role="button">
                    <button type="button" class="btn btn-outline-danger btn-rounded btn-icon">
                        <i class="mdi mdi-delete"></i>
                    </button>
                </a>
            </form>
        @endif
    @endcan