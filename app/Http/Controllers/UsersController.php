<?php

namespace App\Http\Controllers;

use App\Forms\RegisterForm;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Kris\LaravelFormBuilder\FormBuilderTrait;

class UsersController extends Controller
{
    use FormBuilderTrait;


    public function __construct()
    {
        $this->middleware('permission:ADMINISTRATION');

    }


    public function index() {
        $form = $this->form(RegisterForm::class, [
            'method' => 'POST',
            'url' => route('register')
        ]);
        $users = User::all();
        $users = $users->each(function ($user) {
           return  $user->role_id = is_object($user->roles->first()) ? $user->roles->first()->id : null;
        });
        return view('system.users.index', [
            'users' => $users,
            'form' => $form
        ]);
    }

    public function update(Request $request, User $user) {
        $this->validate($request, [
            'name' => 'required',
            'role_id' => 'required'
        ]);
        $user->update([
            'name' => $request->name,
            'region_id' => $request->region_id,
            'verifier_login' => $request->verifier_login,
            'ministere_id' => $request->ministere_id
        ]);
        $user->syncRoles($request->role_id);

        return redirect(route('users.index'))->with('success', 'Opération effectuée !');
    }


    public function destroy(User $user) {
        $user->delete();
        return redirect(route('users.index'))->with('success', 'Opération effectuée !');
    }

    public function changePassword(Request $request) {
        $user = Auth::user();
        if($request->getMethod() === 'POST') {
            if(!Hash::check($request->old_password, $user->password)) {
                return redirect(route('change.password'))->with('danger', 'Le mot de passe est incorrect');
            }
            $this->validate($request, [
                'password' => 'required|min:6|confirmed'
            ]);
            $user->update(['password' => Hash::make($request->password)]);
            return redirect(route('change.password'))->with('success', 'Mot de passe changé');
        }
        return view('system.users.change');
    }
}
