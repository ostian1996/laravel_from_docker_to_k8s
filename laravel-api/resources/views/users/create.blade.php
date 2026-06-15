@extends('layouts.master')
@section('title')
  Ajouter un utilisateur
@endsection

@push('css')
@endpush

@section('content')
  <div class="col-lg-8 col-xl-7 grid-margin stretch-card mx-auto">
  <div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-4">

      <div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-2">
        <div>
          <h4 class="card-title mb-1">Utilisateur</h4>
          <p class="card-description text-muted mb-0">
            Ajouter un nouvel utilisateur
          </p>
        </div>

        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary btn-sm">
          ← Retour
        </a>
      </div>

      <form class="forms-sample" method="POST" action="{{ route('users.store') }}">
        @csrf

        <div class="form-group row mb-3">
          <label for="name" class="col-sm-3 col-form-label fw-semibold">
            Nom et Prénoms
          </label>
          <div class="col-sm-9">
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Jean Doe" required>
              @error('name')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
          </div>
        </div>

        <div class="form-group row mb-3">
          <label for="email" class="col-sm-3 col-form-label fw-semibold">
            Email
          </label>
          <div class="col-sm-9">
            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" required>
              @error('email')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
          </div>
        </div>

        <div class="form-group row mb-3">
          <label for="password" class="col-sm-3 col-form-label fw-semibold">
            Mot de passe
          </label>
          <div class="col-sm-9">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Mot de passe" required>
              @error('password')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
          </div>
        </div>

        <div class="form-group row mb-4">
          <label for="password_confirmation" class="col-sm-3 col-form-label fw-semibold">
            Confirmation
          </label>
          <div class="col-sm-9">
            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder="Confirmer le mot de passe" required>
              @error('password_confirmation')
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
          </div>
        </div>

        <!-- Bloc rôle avec bouton à droite sur la même ligne -->
        <div class="form-group mb-4">
          <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap gap-2">
            <label for="role" class="mb-0 fw-semibold">Rôle</label>
          </div>

          <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
            <option value="">Sélectionner un rôle</option>
            @foreach ($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
          </select>
            @error('role')
              <span class="invalid-feedback">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
        </div>

        <div class="d-flex gap-2">
          <button type="submit" class="btn btn-primary px-4">Ajouter</button>
          <a class="btn btn-light px-4" href="{{ route('users.index') }}">Annuler</a>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

@push('js')
  <script></script>
@endpush