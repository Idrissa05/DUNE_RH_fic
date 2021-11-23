<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use \Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Nexmo\Laravel\Facade\Nexmo;


class AccesAgentController extends Controller
{
    // public function __construct(){
    //     $this->middleware('permission:ACCES_ENSEIGNANT');
    // }

    
    public function create(){
        return view('system.users.agent_register');
    }

    public function store(Request $request){
        $agent = Agent::where('matricule', '=', $request->name)->first();
        if($agent){
            $password = $request->password;
            $username = $request->name;
            $confirmation_code = mt_rand(1000, 9999);
            
            $this->validate($request, [
                'name' => 'required', 'string', 'max:255',
                'password' => 'required', 'string', 'min:8', 'confirmed',
            ]);

            try{
                Nexmo::message()->send([
                    'to'   => $agent->telephone,
                    'from' => 'DUNE RH',
                    'text' => 'Votre code de confirmation est de : ' . $confirmation_code
                ]);
                
            }
            catch (Exception $e){
                echo "Erreur: " . $e->getMessage();
            } 
            
            return view('system.users.confirmation_code', compact('agent', 'password', 'confirmation_code', 'username'));
            
        }else{
            return redirect()->back()->with("error", "Le matricule ou identifiant est invalide, veuillez saisir le matricule ou identifiant correct !");
        }
    }

    public function chech_confirmation_code(Request $request){
        //dd($request->confirmation_code_saisie, $request->confirmation_code);
        if($request->confirmation_code_saisie === $request->confirmation_code){
            $user = User::create([
                'name' => $request->name,
                'password' => Hash::make($request->password)
            ]);

            $user->assignRole('Enseignant');
            return redirect(route('login'))->with("success", "Votre compte a été creé avec succès, veuillez vous connectez pour acceder a vos informations!");
        }else{
            return redirect(route('inscription_agent'))->with("error", "Le code de confirmation est incorrect, veuillez saisir le code que vous reçu par sms de notre part !");
        }
        
    }
}
