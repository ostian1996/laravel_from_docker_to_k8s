@extends('layouts.master')
@section('title')
  Modfier un rôle
@endsection

@push('css')
@endpush

@section('content')
  <div class="col-md-6 grid-margin stretch-card mx-auto">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-2">
          <div>
            <h4 class="card-title mb-1">Rôle</h4>
            <p class="card-description text-muted mb-0">
              MOdifier le rôle {{ $role->name }}
            </p>
          </div>

          <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary btn-sm">
            ← Retour
          </a>
        </div>

        <form class="forms-sample" method="POST" action="{{ route('roles.update', $role) }}">
          @csrf
          @method('PUT')
          <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label">Libellé <span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                              value="{{ $role->name }}"  id="name" placeholder="Supervisor..." required>
              @error('name')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>

          <div class="input-group mb-3">
              <label for="name" class="col-12 form-label">Permissions <span class="text-danger">*</span></label>
              @foreach ($permissions as $permission)
                  <div class="col-md-3 col-sm-4 form-check form-check-success">
                      <input class="form-check-input" name="permissions[]" {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}
                      type="checkbox" value="{{ $permission->id }}" id="{{ 'permission-'.$permission->id }}">
                      <label class="form-check-label" for="{{ 'permission-'.$permission->id }}">
                          {{ $permission->name }}
                      </label>
                  </div>
              @endforeach
          </div>

          <button type="submit" class="btn btn-primary me-2">Modifier</button>
          <a class="btn btn-light" href="{{route('roles.index')}}">Annuler</a>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('js')
  <script></script>
@endpush