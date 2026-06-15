<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function __construct()
    {

        $this->middleware('permission:role.list' , ['only' => ['index' , 'show']]);
        $this->middleware('permission:role.create' , ['only' => ['create' , 'store']]);
        $this->middleware('permission:role.edit' , ['only' => ['edit' , 'update']]);
        $this->middleware('permission:role.delete' , ['only' => 'destroy' ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $roles = Role::all();

            return DataTables::of($roles)
                ->addIndexColumn()
                ->addColumn('action', function($role) {
                    return view('roles.components.action' , ['role' => $role]);
                })
                ->make(true);
        }
        return view('roles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();

        return view('roles.create' , compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $data = $request->validated();
        try {

            DB::beginTransaction();

            $input = [
                'name'          => $data['name'],
                'guard_name'    => 'web'
            ];

            // Create role
            $role = Role::create($input);

            $permissions = Permission::find($data['permissions']);

            // Sync permissions
            $role->syncPermissions($permissions);

            DB::commit();

            return redirect()->route('roles.index')
                            ->with(['success' => 'Rôle créé avec succès.']);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
            return redirect()->back()
                             ->with(['error' => 'Une erreur est survenue. Veuillez réessayer svp!']);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('roles.show' , ['role' => $role]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('roles.edit' , compact('permissions' , 'role'));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(UpdateRoleRequest $request, Role $role)
    {
        $data = $request->validated();

        try {

            DB::beginTransaction();

            $input = [
                'name'          => $data['name'],
                'guard_name'    => 'web'
            ];

            $role->update($input);

            $permissions = Permission::find($data['permissions']);

            // Sync permissions
            $role->syncPermissions($permissions);

            // Update cache
            Artisan::call('permission:cache-reset');

            DB::commit();
            return redirect()->route('roles.index')
                            ->with(['success' => 'Rôle modifié avec succès.']);

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()
                             ->with(['error' => 'Une erreur est survenue. Veuillez réessayer svp!']);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        try {

            DB::beginTransaction();

            foreach ($role->permissions as $key => $permission) {
                $role->revokePermissionTo($permission);
            }
            $role->delete();

            DB::commit();
            return redirect()->route('roles.index')
                            ->with(['success' => 'Rôle supprimé avec succès.']);

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()
                             ->with(['error' => 'Une erreur est survenue. Veuillez réessayer svp!']);
        }

    }
}
