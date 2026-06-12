<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function __construct()
    {

        $this->middleware('permission:user.list' , ['only' => ['index']]);
        $this->middleware('permission:user.create' , ['only' => ['create' , 'store']]);
        $this->middleware('permission:user.edit' , ['only' => ['edit' , 'update']]);
        $this->middleware('permission:user.delete' , ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::orderBy('created_at', 'DESC')->get();
            return DataTables::of($users)
                    ->addIndexColumn()
                    ->addColumn('action' , function($user) {
                        return view('users.components.action' , ['user' => $user]);
                    })
                    ->addColumn('role' , function($user) {
                        return  $user->roles->first()->name;
                    })
                    ->editColumn('status' , function($user) {
                        return !$user->status ? '<span class="mb-1 badge bg-danger">Désactiver</span>' :
                        '<span class="mb-1 badge bg-success">Active</span>';
                    })
                    ->rawColumns(['status'])
                    ->make(true);
        }
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::whereNotIn('name' , ['Entreprise' , 'Commentateur'])->get();

        return view('users.create' , compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        try {

            DB::beginTransaction();

            $data['password'] = bcrypt($data['password']);

            $data['first_connexion'] = true ;

            $role = Role::find($data['role']);

            $user = User::create($data);

            $user->assignRole($role);

            $email_data = [
                'email' => $user->email,
                'password'  => $request->password,
                'fullname'  => $user->name,
                'role'  => $role->name
            ];

            // Mail::to($request->email)->send(new RegistrationMail($email_data));

            DB::commit();

            return redirect()->route('users.index')
                            ->with(['success' => 'Utilisateur créé avec succès.']);

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()
                            ->with(['error' => 'Une erreur est survenue. Veuillez réessayer']);
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit' , compact('user' , 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data =  $request->validated();
        try {
            DB::beginTransaction();

            if (!$data['password']){

                unset($data['password']);

            }else {

                $data['password'] = Hash::make($data['password']);
            }

            $user->update($data);
            $role = Role::findOrFail($data['role']);
            $user->syncRoles($role);

            DB::commit();
            return redirect()->route('users.index')
                            ->with(['success' => 'Utilisateur modifié avec succès.']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()
                                ->with(['error' => 'Une erreur est survenue. Veuillez réessayer']);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {

        if ($user->delete()) {

            return redirect()->route('users.index')
                            ->with(['success' => 'Utilisateur supprimé avec succès']);
        } else {
            redirect()->back()->with(['error' => 'Erreur! Veuillez réessayer']);
        }
    }

    public function changeState(Request $request , User $user)
    {
        if($user->enabled)
            $user->update(['enabled' => false]);
        else
            $user->update(['enabled' => true]);

        return redirect()->back()
            ->with(['success' => "Le statut de l'utilisateur a été modifié avec succès"]);
    }
}
