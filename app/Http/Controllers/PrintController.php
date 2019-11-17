<?php

namespace App\Http\Controllers;

use App\Config;
use App\Exports\AffectationsExport;
use App\Exports\AgentsExport;
use App\Exports\ParCategorieSexeExport;
use App\Exports\ParCorpExport;
use App\Exports\ParMatrimonialeExport;
use App\Exports\ParPositionExport;
use App\Exports\RetraitablesExport;
use App\Models\Affectation;
use App\Models\Agent;
use App\Models\Avancement;
use function foo\func;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Mpdf\Mpdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class PrintController extends Controller
{
    public function agents() {
        return (new AgentsExport())->download('agents.xlsx');
    }


    public function retraitables() {
        return (new RetraitablesExport())->download('agents_retraitables.xlsx');

    }

    public function listParCategorieParSexe(Request $request) {
        return (new ParCategorieSexeExport($request->sexe, $request->categorie))->download('agents.xlsx');
    }

    public function listParCorp(Request $request) {
        return (new ParCorpExport($request->corp))->download('agents.xlsx');
    }

    public function listParPosition(Request $request) {
        return (new ParPositionExport($request->position))->download('agents.xlsx');
    }

    public function listParMatrimoniale(Request $request) {
        return (new ParMatrimonialeExport($request->matrimoniale))->download('agents.xlsx');
    }


    public function infos(Request $request) {
        $agent = Agent::findOrFail($request->agent);
        $agent->load(['enfants', 'conjoints', 'formations', 'experiences','grades' => function($query) {
            return $query;
        }]);
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
        return (new AffectationsExport($request))->download('agents_affectations.xlsx');

    }
}
