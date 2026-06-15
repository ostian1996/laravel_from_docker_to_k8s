
@extends('layouts.master')
@section('title')
  Détails sur le rôle {{ $role->name }}
@endsection

@push('css')
@endpush

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-2">
                    <div>
                        <h4 class="card-title mb-1">Rôle</h4>
                        <p class="card-description text-muted mb-0">
                        détail sur le rôle {{ $role->name }}
                        </p>
                    </div>

                    <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary btn-sm">
                        ← Retour
                    </a>
                </div>
                <h5 class="card-title">Libellé : {{ $role->name }}</h5>
                <h5 class="card-title mb-2">Permissions : </h5>
                <div class="row">
                    @if (count($role->permissions) == 0)
                    <div class="col-12 text-center">
                        <h5>Pas de permission associée</h5>
                    </div>        
                    @else
                        @foreach ($role->permissions as $permission)
                            <div class="col-3">
                                <span class="side-badge badge bg-secondary mb-2 me-4" style="font-size: 14px;">{{ $permission->name }}</span>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
  <script></script>
@endpush