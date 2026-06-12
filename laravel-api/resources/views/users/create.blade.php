@extends('layouts.master')
@section('title')
  Ajouter un utilisateur
@endsection

@push('css')
@endpush

@section('content')
  <div class="col-md-6 grid-margin stretch-card mx-auto">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Utilisateur</h4>
        <p class="card-description">
          Ajouter un nouvel utilisateur
        </p>
        <form class="forms-sample" method="POST" action="{{ route('users.store') }}">
          <div class="form-group row">
            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Nom et Prénoms</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="exampleInputUsername2" placeholder="Jean Doe">
            </div>
          </div>
          <div class="form-group row">
            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-9">
              <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Email">
            </div>
          </div>
          <div class="form-group row">
            <label for="exampleInputMobile" class="col-sm-3 col-form-label">Mobile</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="exampleInputMobile" placeholder="Mobile number">
            </div>
          </div>
          <div class="form-group row">
            <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Password</label>
            <div class="col-sm-9">
              <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
            </div>
          </div>
          <div class="form-group row">
            <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Re Password</label>
            <div class="col-sm-9">
              <input type="password" class="form-control" id="exampleInputConfirmPassword2" placeholder="Password">
            </div>
          </div>
          <button type="submit" class="btn btn-primary me-2">Ajouter</button>
          <a class="btn btn-light" href="{{ route('users.index') }}">Annuler</a>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('js')
  <script></script>
@endpush