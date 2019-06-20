<?php

namespace App\Http\Controllers;

use App\Config;
use App\Models\Agent;
use function foo\func;
use Illuminate\Http\Request;
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
           return $agent->date_naiss->diffInMonths(date('Y-m-d')) >= (Config::first()->age_retraite * 12) - 3;
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
}
