@extends('layouts.master')
@section('title')
  Créer un rôle
@endsection

@push('css')
@endpush

@section('content')
  <div class="col-md-6 grid-margin stretch-card mx-auto">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Rôle</h4>
        <p class="card-description">
          Ajouter un nouveau rôle
        </p>
        <form class="forms-sample" method="POST" action="{{ route('roles.store') }}">
          <div class="form-group row">
            <label for="name" class="col-sm-3 col-form-label">Libellé <span class="text-danger">*</span></label>
            <div class="col-sm-9">
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Superviseur" required>
              @error('name')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>

          <div class="input-group mb-3">
            <label for="name" class="col-12 form-label mb-2">Permissions <span class="text-danger">*</span></label>
            @foreach ($permissions as $permission)
                <div class="col-3 form-check form-check-success">
                    <input class="form-check-input" name="permissions[]" type="checkbox" value="{{ $permission->id }}" id="{{ 'permission-'.$permission->id }}">
                    <label class="form-check-label" for="{{ 'permission-'.$permission->id }}">
                        {{ $permission->name }}
                    </label>
                </div>
            @endforeach
          </div>

          <button type="submit" class="btn btn-primary me-2">Créer</button>
          <a class="btn btn-light" href="{{route('roles.index')}}">Annuler</a>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('js')
  <script></script>
@endpush