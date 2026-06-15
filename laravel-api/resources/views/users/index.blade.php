@extends('layouts.master')
@section('title')
  Utilisateurs
@endsection

@push('css')
@endpush

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h4 class="card-title mb-0">Utilisateurs</h4>
                        <p class="card-description mb-0">Découvrez la liste des Utilisateurs</p>
                    </div>
                    <div>
                        <a href="{{ route('users.create') }}" type="button" class="btn btn-primary btn-icon-text">
                            <i class="mdi mdi-plus-circle-outline btn-icon-prepend"></i>
                            Ajouter
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="table" class="table table-striped">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Nom et Prénoms</th>
                                <th>Email</th>
                                <th>Rôle</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')

<script type="text/javascript">
  $(function () {
    $('#table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('users.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {
                data: 'name', 
                name: 'name'
            },{
                data: 'email', 
                name: 'email'
            },{
                data: 'role', 
                name: 'role'
            },{
                data: 'status', 
                name: 'status'
            },

            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
  });
</script>
@endpush