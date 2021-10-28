<?php

namespace App\Http\Controllers;

use App\Forms\RegisterForm;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use App\ModelS\Agent;
use Nexmo\Laravel\Facade\Nexmo;

class UsersController extends Controller
{
    use FormBuilderTrait;


    // public function __construct()
    // {
    //     $this->middleware('permission:ADMINISTRATION');

    // }
    
    public function index() {
        $form = $this->form(RegisterForm::class, [
            'method' => 'POST',
            'url' => route('register')
        ]);
        $users = User::all();
        //dd($users);
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

    public function reinitialiser_password(Request $request){
        $confirmation_code = mt_rand(1000, 9999);
        $matricule = $request->matricule;
        $agent = Agent::where('matricule', '=', $request->matricule)->first();
        //dd($agent);
        if($agent){
            try{
                Nexmo::message()->send([
                    'to'   => $agent->telephone,
                    'from' => 'DUNE RH',
                    'text' => 'Votre code de réinitialisation de mot de passe est de : ' .$confirmation_code
                ]);
                
            }
            catch (Exception $e){
                echo "Erreur: " . $e->getMessage();
            } 

            return view('system.users.change_password_confirmation', compact('agent', 'confirmation_code', 'matricule'));
        }else{
            return redirect()->back()->with("error", "Le matricule ou identifiant est invalide, veuillez saisir le matricule ou identifiant correct !");
        }
    }

    public function check_password_change(Request $request){
        $matricule = $request->matricule;
        //dd($matricule);
        $confirmation_code = $request->confirmation_code;
        if($request->getMethod() === 'POST') {
            if($request->confirmation_code_saisie === $request->confirmation_code){
                return view('system.users.change_pasword_store', compact('matricule', 'confirmation_code'));
            }else{
                return redirect()->back()->with("error", "Le code de réinitialisation est incorrect, veuillez saisir le code que vous reçu par sms de notre part !");
            }
        }

        return redirect()->back();
        
    }

    public function new_password_store(Request $request){
        //dd($request->all());
        $user = User::where('name', '=', $request->matricule)->first();
            if($user){
                if($request->new_password === $request->confirmed_new_password){
                    //dd($request->password);
                    $user->update(['password' => Hash::make($request->new_password)]);
                    return redirect(route('login'))->with("success", "Votre mot de passe a été réinitialiser avec succès, veuillez vous connectez pour acceder a vos informations!");
                }else{
                    return redirect()->back()->with("error", "Les mots de passe ne correspondent pas !");
                }
                
           }else{
                return redirect()->back()->with("error", "Utilisateur n'existe pas!");
            }
    }
}
