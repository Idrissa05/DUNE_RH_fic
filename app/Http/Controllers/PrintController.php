<?php

namespace App\Http\Controllers;

use App\Config;
use App\Models\Affectation;
use App\Models\Agent;
use App\Models\Avancement;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Mpdf\Mpdf;

class PrintController extends Controller
{
    public function agents() {
        $agents = Agent::all();

        $mpdf = new Mpdf();
        $view = view('pdf.agents', ['agents' => $agents])->render();
        $mpdf->WriteHTML($view);
        $mpdf->Output();
    }


    public function retraitables() {
        $agents = Agent::all();

        $agents = $agents->filter(function ($agent) {
           return (new Carbon($agent->date_naiss))->diffInMonths(date('Y-m-d')) >= (Config::first()->age_retraite * 12) - 3;
        });

        $mpdf = new Mpdf();
        $view = view('pdf.retraitables', ['agents' => $agents])->render();
        $mpdf->WriteHTML($view);
        $mpdf->Output();
    }

    public function listParCategorieParSexe(Request $request) {
        $agents = Agent::with('corp','corp.category');
        if($request->sexe) {
            $agents->where('sexe', '=', $request->sexe);
        }
        $agents = $agents->get();

        if($request->categorie) {
            $agents = $agents->filter(function ($agent) use ($request){
                return $agent->corp->category_id == $request->categorie;
            });
        }

        $mpdf = new Mpdf();
        $view = view('pdf.list', ['agents' => $agents])->render();
        $mpdf->WriteHTML($view);
        $mpdf->Output();
    }

    public function listParCorp(Request $request) {
        $agents = Agent::with('corp');

        if($request->corp) {
            $agents->where('corp_id', '=', $request->corp);
        }
        $agents = $agents->get();
        $mpdf = new Mpdf();
        $view = view('pdf.corps', ['agents' => $agents])->render();
        $mpdf->WriteHTML($view);
        $mpdf->Output();
    }

    public function listParPosition(Request $request) {
        $agents = Agent::with('positions');
        $agents = $agents->get();
        $agents = $agents->filter(function ($agent) use($request){
            return $agent->positions->count() > 0;
        });
        if($request->position) {
            $agents = $agents->filter(function ($agent) use($request){
                return $agent->positions->last()->id == $request->position;
            });
        }
        $mpdf = new Mpdf();
        $view = view('pdf.positions', ['agents' => $agents])->render();
        $mpdf->WriteHTML($view);
        $mpdf->Output();
    }

    public function listParMatrimoniale(Request $request) {
        $agents = Agent::with('matrimoniales');
        $agents = $agents->get();
        $agents = $agents->filter(function ($agent) use($request){
            return $agent->matrimoniales->count() > 0;
        });
        if($request->matrimoniale) {
            $agents = $agents->filter(function ($agent) use($request){
                return $agent->matrimoniales->last()->id == $request->matrimoniale;
            });
        }
        $mpdf = new Mpdf();
        $view = view('pdf.matrimoniales', ['agents' => $agents])->render();
        $mpdf->WriteHTML($view);
        $mpdf->Output();
    }


    public function infos(Request $request) {
        $agent = Agent::findOrFail($request->agent);
        $agent->load('enfants', 'conjoints', 'formations', 'corp', 'cadre', 'experiences');
        $mpdf = new Mpdf();
        $view = view('pdf.infos', ['agent' => $agent])->render();
        $mpdf->WriteHTML($view);
        $mpdf->Output();
    }

    public function history(Request $request) {
        $avancements = Avancement::where('agent_id', '=', $request->agent)->get();
        $mpdf = new Mpdf();
        $view = view('pdf.avancements', ['avancements' => $avancements])->render();
        $mpdf->WriteHTML($view);
        $mpdf->Output();
    }


    public function par(Request $request) {
        $query = Affectation::query()
            ->join('agents', 'agents.id', '=', 'affectations.agent_id')
            ->join('etablissements', 'etablissements.id', '=', 'affectations.etablissement_id')
            ->join('secteur_pedagogiques', 'secteur_pedagogiques.id', 'etablissements.secteur_pedagogique_id')
            ->join('inspections', 'inspections.id', '=', 'secteur_pedagogiques.inspection_id')
            ->join('communes', 'communes.id', '=', 'inspections.commune_id')
            ->join('departements', 'departements.id', 'communes.departement_id')
            ->join('regions', 'regions.id', 'departements.region_id')
            ->orderByDesc('affectations.created_at')
            ->whereRaw('affectations.created_at = (SELECT max(affectations.created_at) from affectations where affectations.agent_id=agents.id)')
            ->selectRaw('agents.id ,affectations.created_at, agents.matricule, agents.nom, agents.prenom,agents.sexe, regions.name as region, departements.name as departement, inspections.name as inspection, secteur_pedagogiques.name secteur');
        if($request->region) {
            $query->where('regions.id', '=', $request->region);
        }
        if($request->departement) {
            $query->where('departements.id', '=', $request->departement);
        }
        if($request->inspection) {
            $query->where('inspections.id', '=', $request->inspection);
        }
        if($request->secteur) {
            $query->where('secteur_pedagogiques.id', '=', $request->secteur);
        }
        if($request->sexe) {
            $query->where('agents.sexe', '=', $request->sexe);
        }
        $affectations = $query->get();
        $mpdf = new Mpdf();
        $view = view('pdf.affectations', ['affectations' => $affectations])->render();
        $mpdf->WriteHTML($view);
        $mpdf->Output();
    }
}
