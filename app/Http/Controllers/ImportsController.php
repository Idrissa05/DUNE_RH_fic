<?php

namespace App\Http\Controllers;

use App\Models\Affectation;
use App\Models\Agent;
use App\Models\Auxiliaire;
use App\Models\Auxiliairement;
use App\Models\Avancement;
use App\Models\Cadre;
use App\Models\CategoryAuxiliaire;
use App\Models\Commune;
use App\Models\Conge;
use App\Models\Conjoint;
use App\Models\Contractuel;
use App\Models\Contrat;
use App\Models\Corp;
use App\Models\Dece;
use App\Models\Departement;
use App\Models\Diplome;
use App\Models\EcoleFormation;
use App\Models\Enfant;
use App\Models\EquivalenceDiplome;
use App\Models\Etablissement;
use App\Models\Experience;
use App\Models\Fonction;
use App\Models\Formation;
use App\Models\Indice;
use App\Models\Inspection;
use App\Models\Maladie;
use App\Models\Matrimoniale;
use App\Models\NiveauEtude;
use App\Models\Notation;
use App\Models\Position;
use App\Models\Reclassement;
use App\Models\Retraite;
use App\Models\SecteurPedagogique;
use App\Models\Titulaire;
use App\Models\Titularisation;
use App\Models\TypeEtablissement;
use Illuminate\Support\Facades\DB;

ini_set ('memory_limit' , -1) ;
set_time_limit (3000);

class ImportsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:IMPORTER_EXCEL');
    }

    public function create()
    {
        return view('import.import_page');
    }

    public function store()
    {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $reader->setReadDataOnly(true);
        //$reader->setLoadSheetsOnly([request()->request->get('fields')]);
        $spreadsheet = $reader->load(request()->file('input-file'));
        $worksheetData = $reader->listWorksheetInfo(request()->file('input-file'));

        $result = [];
        foreach (request()->request->get('fields') as $sheetNumber){
            $sheetName = $worksheetData[$sheetNumber]['worksheetName'];
            $resp = $this->$sheetName($spreadsheet, $sheetName ,$worksheetData[$sheetNumber]['totalRows']);
            if($resp) array_push($result, $sheetName);
        }

        if($result) return response()->json($result);
        else return response()->json(['success' => true]);
    }

    private function Departements($spreadsheet, $sheetName ,$totalRows){
        try {
            DB::beginTransaction();
            for ($i = 2; $i <= $totalRows; $i++) {
                if ($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue() != "") {
                    Departement::firstOrCreate([
                        'id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue()),
                        'name' => $spreadsheet->getSheetByName($sheetName)->getCell('B' . $i)->getValue(),
                        'region_id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('C' . $i)->getValue()),
                    ]);
                }
            }
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            return 'Error';
        }
    }

    private function Communes($spreadsheet, $sheetName ,$totalRows){
        try {
            DB::beginTransaction();
            for ($i = 2; $i <= $totalRows; $i++) {
                if ($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue() != "") {
                    Commune::firstOrCreate([
                        'id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue()),
                        'name' => $spreadsheet->getSheetByName($sheetName)->getCell('B' . $i)->getValue(),
                        'departement_id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('C' . $i)->getValue()),
                    ]);
                }
            }
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            return 'Error';
        }
    }

    private function Inspections($spreadsheet, $sheetName ,$totalRows){
        try {
            DB::beginTransaction();
            for ($i = 2; $i <= $totalRows; $i++) {
                if ($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue() != "") {
                    Inspection::firstOrCreate([
                        'id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue()),
                        'name' => $spreadsheet->getSheetByName($sheetName)->getCell('B' . $i)->getValue(),
                        'commune_id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('C' . $i)->getValue()),
                    ]);
                }
            }
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            return 'Error';
        }
    }

    private function SecteurPedagogiques($spreadsheet, $sheetName ,$totalRows){
        try {
            DB::beginTransaction();
            for ($i = 2; $i <= $totalRows; $i++) {
                if ($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue() != "") {
                    SecteurPedagogique::firstOrCreate([
                        'id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue()),
                        'name' => $spreadsheet->getSheetByName($sheetName)->getCell('B' . $i)->getValue(),
                        'inspection_id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('C' . $i)->getValue()),
                    ]);
                }
            }
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            return 'Error';
        }
    }

    private function TypeEtablissements($spreadsheet, $sheetName ,$totalRows){
        try {
            DB::beginTransaction();
            for ($i = 2; $i <= $totalRows; $i++) {
                if ($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue() != "") {
                    TypeEtablissement::firstOrCreate([
                        'id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue()),
                        'name' => $spreadsheet->getSheetByName($sheetName)->getCell('B' . $i)->getValue()
                    ]);
                }
            }
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            return 'Error';
        }
    }

    private function Etablissements($spreadsheet, $sheetName ,$totalRows){
        try {
            DB::beginTransaction();
            for ($i = 2; $i <= $totalRows; $i++) {
                if ($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue() != "") {
                    Etablissement::firstOrCreate([
                        'id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue()),
                        'name' => $spreadsheet->getSheetByName($sheetName)->getCell('B' . $i)->getValue(),
                        'secteur_pedagogique_id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('C' . $i)->getValue()),
                        'type_etablissement_id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('D' . $i)->getValue()),
                    ]);
                }
            }
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            return 'Error';
        }
    }

    private function Cadres($spreadsheet, $sheetName ,$totalRows){
        try {
            DB::beginTransaction();
            for ($i = 2; $i <= $totalRows; $i++) {
                if ($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue() != "") {
                    Cadre::firstOrCreate([
                        'id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue()),
                        'name' => $spreadsheet->getSheetByName($sheetName)->getCell('B' . $i)->getValue(),
                        'abreviation' => $spreadsheet->getSheetByName($sheetName)->getCell('C' . $i)->getValue(),
                    ]);
                }
            }
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            return 'Error';
        }
    }

    private function CategorieAuxiliaires($spreadsheet, $sheetName ,$totalRows){
        try {
            DB::beginTransaction();
            for ($i = 2; $i <= $totalRows; $i++) {
                if ($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue() != "") {
                    CategoryAuxiliaire::firstOrCreate([
                        'id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue()),
                        'name' => $spreadsheet->getSheetByName($sheetName)->getCell('B' . $i)->getValue()
                    ]);
                }
            }
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            return 'Error';
        }
    }

    private function Corps($spreadsheet, $sheetName ,$totalRows){
        try {
            DB::beginTransaction();
            for ($i = 2; $i <= $totalRows; $i++) {
                if ($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue() != "") {
                    Corp::firstOrCreate([
                        'id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue()),
                        'name' => $spreadsheet->getSheetByName($sheetName)->getCell('B' . $i)->getValue(),
                        'abreviation' => $spreadsheet->getSheetByName($sheetName)->getCell('C' . $i)->getValue(),
                        'category_id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('D' . $i)->getValue())
                    ]);
                }
            }
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            return 'Error';
        }
    }

    private function Fonctions($spreadsheet, $sheetName ,$totalRows){
        try {
            DB::beginTransaction();
            for ($i = 2; $i <= $totalRows; $i++) {
                if ($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue() != "") {
                    Fonction::firstOrCreate([
                        'id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue()),
                        'name' => $spreadsheet->getSheetByName($sheetName)->getCell('B' . $i)->getValue()
                    ]);
                }
            }
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            return 'Error';
        }
    }

    private function Auxiliaires($spreadsheet, $sheetName ,$totalRows){
        try {
            DB::beginTransaction();
            for ($i = 2; $i <= $totalRows; $i++) {
                if ($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue() != "") {
                    $auxiliaire = Auxiliaire::firstOrCreate([
                        'matricule' => trim($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue()),
                        'nom' => $spreadsheet->getSheetByName($sheetName)->getCell('B' . $i)->getValue(),
                        'prenom' => $spreadsheet->getSheetByName($sheetName)->getCell('C' . $i)->getValue(),
                        'date_naiss' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($spreadsheet->getSheetByName($sheetName)->getCell('D' . $i)->getValue())->format('Y-m-d'),
                        'lieu_naiss' => $spreadsheet->getSheetByName($sheetName)->getCell('E' . $i)->getValue(),
                        'ref_acte_naiss' => $spreadsheet->getSheetByName($sheetName)->getCell('F' . $i)->getValue(),
                        'date_etablissement_acte_naiss' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($spreadsheet->getSheetByName($sheetName)->getCell('G' . $i)->getValue())->format('Y-m-d'),
                        'lieu_etablissement_acte_naiss' => $spreadsheet->getSheetByName($sheetName)->getCell('H' . $i)->getValue(),
                        'sexe' => $spreadsheet->getSheetByName($sheetName)->getCell('I' . $i)->getValue(),
                        'nationnalite' => $spreadsheet->getSheetByName($sheetName)->getCell('J' . $i)->getValue(),
                        'date_prise_service' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($spreadsheet->getSheetByName($sheetName)->getCell('K' . $i)->getValue())
                    ]);
                    Auxiliairement::firstOrCreate([
                        'agent_id' => $auxiliaire->id,
                        'category_auxiliaire_id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('O' . $i)->getValue()),
                        'cadre_id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('L' . $i)->getValue()),
                        'corp_id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('N' . $i)->getValue()),
                        'fonction_id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('M' . $i)->getValue()),
                        'ref_engagement' => $spreadsheet->getSheetByName($sheetName)->getCell('P' . $i)->getValue(),
                        'date_engagement' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($spreadsheet->getSheetByName($sheetName)->getCell('Q' . $i)->getValue())->format('Y-m-d')
                    ]);
                }
            }
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            return 'Error';
        }
    }

    private function Contractuels($spreadsheet, $sheetName ,$totalRows){
        try {
            DB::beginTransaction();
            for ($i = 2; $i <= $totalRows; $i++) {
                if ($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue() != "") {
                    $contractuel = Contractuel::firstOrCreate([
                        'matricule' => trim($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue()),
                        'nom' => $spreadsheet->getSheetByName($sheetName)->getCell('B' . $i)->getValue(),
                        'prenom' => $spreadsheet->getSheetByName($sheetName)->getCell('C' . $i)->getValue(),
                        'date_naiss' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($spreadsheet->getSheetByName($sheetName)->getCell('D' . $i)->getValue())->format('Y-m-d'),
                        'lieu_naiss' => $spreadsheet->getSheetByName($sheetName)->getCell('E' . $i)->getValue(),
                        'ref_acte_naiss' => $spreadsheet->getSheetByName($sheetName)->getCell('F' . $i)->getValue(),
                        'date_etablissement_acte_naiss' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($spreadsheet->getSheetByName($sheetName)->getCell('G' . $i)->getValue())->format('Y-m-d'),
                        'lieu_etablissement_acte_naiss' => $spreadsheet->getSheetByName($sheetName)->getCell('H' . $i)->getValue(),
                        'sexe' => $spreadsheet->getSheetByName($sheetName)->getCell('I' . $i)->getValue(),
                        'nationnalite' => $spreadsheet->getSheetByName($sheetName)->getCell('J' . $i)->getValue(),
                        'date_prise_service' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($spreadsheet->getSheetByName($sheetName)->getCell('K' . $i)->getValue())
                    ]);
                    Contrat::firstOrCreate([
                        'agent_id' => $contractuel->id,
                        'category_id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('O' . $i)->getValue()),
                        'cadre_id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('L' . $i)->getValue()),
                        'corp_id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('N' . $i)->getValue()),
                        'fonction_id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('M' . $i)->getValue()),
                        'ref_engagement' => $spreadsheet->getSheetByName($sheetName)->getCell('P' . $i)->getValue(),
                        'date_engagement' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($spreadsheet->getSheetByName($sheetName)->getCell('Q' . $i)->getValue())->format('Y-m-d')
                    ]);
                }
            }
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            return 'Error';
        }
    }

    private function Titulaires($spreadsheet, $sheetName ,$totalRows){
        try {
            DB::beginTransaction();
            for ($i = 2; $i <= $totalRows; $i++) {
                if ($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue() != "") {
                    $titulaire = Titulaire::firstOrCreate([
                        'matricule' => trim($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue()),
                        'nom' => $spreadsheet->getSheetByName($sheetName)->getCell('B' . $i)->getValue(),
                        'prenom' => $spreadsheet->getSheetByName($sheetName)->getCell('C' . $i)->getValue(),
                        'date_naiss' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($spreadsheet->getSheetByName($sheetName)->getCell('D' . $i)->getValue())->format('Y-m-d'),
                        'lieu_naiss' => $spreadsheet->getSheetByName($sheetName)->getCell('E' . $i)->getValue(),
                        'ref_acte_naiss' => $spreadsheet->getSheetByName($sheetName)->getCell('F' . $i)->getValue(),
                        'date_etablissement_acte_naiss' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($spreadsheet->getSheetByName($sheetName)->getCell('G' . $i)->getValue())->format('Y-m-d'),
                        'lieu_etablissement_acte_naiss' => $spreadsheet->getSheetByName($sheetName)->getCell('H' . $i)->getValue(),
                        'sexe' => $spreadsheet->getSheetByName($sheetName)->getCell('I' . $i)->getValue(),
                        'nationnalite' => $spreadsheet->getSheetByName($sheetName)->getCell('J' . $i)->getValue()
                    ]);

                    $indice = Indice::where('category_id', trim($spreadsheet->getSheetByName($sheetName)->getCell('N' . $i)->getValue()))->where('classe_id', trim($spreadsheet->getSheetByName($sheetName)->getCell('O' . $i)->getValue()))->where('echelon_id', trim($spreadsheet->getSheetByName($sheetName)->getCell('P' . $i)->getValue()))->get(['id'])[0]->id ?? null;
                    Titularisation::firstOrCreate([
                        'agent_id' => $titulaire->id,
                        'category_id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('N' . $i)->getValue()),
                        'cadre_id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('K' . $i)->getValue()),
                        'corp_id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('M' . $i)->getValue()),
                        'classe_id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('O' . $i)->getValue()),
                        'echelon_id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('P' . $i)->getValue()),
                        'fonction_id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('L' . $i)->getValue()),
                        'ref_engagement' => $spreadsheet->getSheetByName($sheetName)->getCell('Q' . $i)->getValue(),
                        'date_engagement' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($spreadsheet->getSheetByName($sheetName)->getCell('R' . $i)->getValue())->format('Y-m-d'),
                        'ref_titularisation' => $spreadsheet->getSheetByName($sheetName)->getCell('S' . $i)->getValue(),
                        'date_titularisation' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($spreadsheet->getSheetByName($sheetName)->getCell('T' . $i)->getValue())->format('Y-m-d'),
                        'indice_id' => $indice,
                    ]);
                }
            }
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            return 'Error';
        }
    }

    private function Affectations($spreadsheet, $sheetName ,$totalRows){
        try {
            DB::beginTransaction();
            for ($i = 2; $i <= $totalRows; $i++) {
                if ($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue() != "") {
                    $agent = Agent::where('matricule', trim($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue()))->get(['id']);
                    if(isset($agent[0]->id)){
                        Affectation::firstOrCreate([
                            'ref' => $spreadsheet->getSheetByName($sheetName)->getCell('B' . $i)->getValue(),
                            'date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($spreadsheet->getSheetByName($sheetName)->getCell('C' . $i)->getValue())->format('Y-m-d'),
                            'date_prise_effet' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($spreadsheet->getSheetByName($sheetName)->getCell('D' . $i)->getValue())->format('Y-m-d'),
                            'observation' => $spreadsheet->getSheetByName($sheetName)->getCell('F' . $i)->getValue(),
                            'agent_id' => $agent[0]->id,
                            'etablissement_id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('E' . $i)->getValue())
                        ]);
                    }

                }
            }
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            return 'Error';
        }
    }

    private function Avancements($spreadsheet, $sheetName ,$totalRows){
        try {
            DB::beginTransaction();
            for ($i = 2; $i <= $totalRows; $i++) {
                if ($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue() != "") {
                    $agent = Agent::where('matricule', $spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue())->get(['id']);
                    $indice = Indice::where('category_id', trim($spreadsheet->getSheetByName($sheetName)->getCell('G' . $i)->getValue()))->where('classe_id', trim($spreadsheet->getSheetByName($sheetName)->getCell('H' . $i)->getValue()))->where('echelon_id', trim($spreadsheet->getSheetByName($sheetName)->getCell('I' . $i)->getValue()))->get(['id'])[0]->id;
                    if(isset($agent[0]->id)) {
                        Avancement::firstOrCreate([
                            'agent_id' => $agent[0]->id,
                            'ref_avancement' => $spreadsheet->getSheetByName($sheetName)->getCell('B' . $i)->getValue(),
                            'date_decision_avancement' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($spreadsheet->getSheetByName($sheetName)->getCell('C' . $i)->getValue())->format('Y-m-d'),
                            'category_id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('G' . $i)->getValue()),
                            'cadre_id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('D' . $i)->getValue()),
                            'corp_id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('F' . $i)->getValue()),
                            'classe_id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('H' . $i)->getValue()),
                            'echelon_id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('I' . $i)->getValue()),
                            'fonction_id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('E' . $i)->getValue()),
                            'observation' => $spreadsheet->getSheetByName($sheetName)->getCell('J' . $i)->getValue(),
                            'indice_id' => $indice,
                        ]);
                    }
                }
            }
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            return 'Error';
        }
    }

    private function Reclassements($spreadsheet, $sheetName ,$totalRows){
        try {
            DB::beginTransaction();
            for ($i = 2; $i <= $totalRows; $i++) {
                if ($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue() != "") {
                    $agent = Agent::where('matricule', $spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue())->get(['id']);
                    $indice = Indice::where('category_id', trim($spreadsheet->getSheetByName($sheetName)->getCell('G' . $i)->getValue()))->where('classe_id', trim($spreadsheet->getSheetByName($sheetName)->getCell('H' . $i)->getValue()))->where('echelon_id', trim($spreadsheet->getSheetByName($sheetName)->getCell('I' . $i)->getValue()))->get(['id'])[0]->id;
                    if(isset($agent[0]->id)) {
                        Reclassement::firstOrCreate([
                            'agent_id' => $agent[0]->id,
                            'ref_reclassement' => $spreadsheet->getSheetByName($sheetName)->getCell('B' . $i)->getValue(),
                            'date_reclassement' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($spreadsheet->getSheetByName($sheetName)->getCell('C' . $i)->getValue())->format('Y-m-d'),
                            'category_id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('G' . $i)->getValue()),
                            'cadre_id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('D' . $i)->getValue()),
                            'corp_id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('F' . $i)->getValue()),
                            'classe_id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('H' . $i)->getValue()),
                            'echelon_id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('I' . $i)->getValue()),
                            'fonction_id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('E' . $i)->getValue()),
                            'observation' => $spreadsheet->getSheetByName($sheetName)->getCell('J' . $i)->getValue(),
                            'indice_id' => $indice,
                        ]);
                    }
                }
            }
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            return 'Error';
        }
    }

    private function Conges($spreadsheet, $sheetName ,$totalRows){
        try {
            DB::beginTransaction();
            for ($i = 2; $i <= $totalRows; $i++) {
                if ($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue() != "") {
                    $agent = Agent::where('matricule', $spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue())->get(['id']);
                    if(isset($agent[0]->id)) {
                        Conge::firstOrCreate([
                            'agent_id' => $agent[0]->id,
                            'ref_decision' => $spreadsheet->getSheetByName($sheetName)->getCell('B' . $i)->getValue(),
                            'date_debut' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($spreadsheet->getSheetByName($sheetName)->getCell('C' . $i)->getValue())->format('Y-m-d'),
                            'date_fin' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($spreadsheet->getSheetByName($sheetName)->getCell('D' . $i)->getValue())->format('Y-m-d'),
                            'observation' => $spreadsheet->getSheetByName($sheetName)->getCell('E' . $i)->getValue()
                        ]);
                    }
                }
            }
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            return 'Error';
        }
    }

    private function Conjoints($spreadsheet, $sheetName ,$totalRows){
        try {
            DB::beginTransaction();
            for ($i = 2; $i <= $totalRows; $i++) {
                if ($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue() != "") {
                    $agent = Agent::where('matricule', $spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue())->get(['id']);
                    if(isset($agent[0]->id)) {
                        Conjoint::firstOrCreate([
                            'agent_id' => $agent[0]->id,
                            'nom' => $spreadsheet->getSheetByName($sheetName)->getCell('B' . $i)->getValue(),
                            'prenom' => $spreadsheet->getSheetByName($sheetName)->getCell('C' . $i)->getValue(),
                            'date_naiss' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($spreadsheet->getSheetByName($sheetName)->getCell('D' . $i)->getValue())->format('Y-m-d'),
                            'lieu_naiss' => $spreadsheet->getSheetByName($sheetName)->getCell('E' . $i)->getValue(),
                            'ref_acte_naiss' => $spreadsheet->getSheetByName($sheetName)->getCell('F' . $i)->getValue(),
                            'sexe' => $spreadsheet->getSheetByName($sheetName)->getCell('G' . $i)->getValue(),
                            'nationnalite' => $spreadsheet->getSheetByName($sheetName)->getCell('H' . $i)->getValue(),
                            'telephone' => $spreadsheet->getSheetByName($sheetName)->getCell('I' . $i)->getValue(),
                            'employeur' => trim($spreadsheet->getSheetByName($sheetName)->getCell('J' . $i)->getValue()),
                            'matricule' => trim($spreadsheet->getSheetByName($sheetName)->getCell('K' . $i)->getValue()),
                            'profession' => trim($spreadsheet->getSheetByName($sheetName)->getCell('L' . $i)->getValue()),
                            'ref_acte_mariage' => trim($spreadsheet->getSheetByName($sheetName)->getCell('M' . $i)->getValue()),
                            'date_mariage' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($spreadsheet->getSheetByName($sheetName)->getCell('N' . $i)->getValue()),
                        ]);
                    }
                }
            }
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            return 'Error';
        }
    }

    private function Deces($spreadsheet, $sheetName ,$totalRows){
        try {
            DB::beginTransaction();
            for ($i = 2; $i <= $totalRows; $i++) {
                if ($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue() != "") {
                    $agent = Agent::where('matricule', $spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue())->get(['id']);
                    if(isset($agent[0]->id)) {
                        Dece::firstOrCreate([
                            'agent_id' => $agent[0]->id,
                            'date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($spreadsheet->getSheetByName($sheetName)->getCell('B' . $i)->getValue())->format('Y-m-d'),
                            'ref_document' => $spreadsheet->getSheetByName($sheetName)->getCell('C' . $i)->getValue(),
                            'observation' => $spreadsheet->getSheetByName($sheetName)->getCell('D' . $i)->getValue()
                        ]);
                    }
                }
            }
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            return 'Error';
        }
    }

    private function Enfants($spreadsheet, $sheetName ,$totalRows){
        try {
            DB::beginTransaction();
            for ($i = 2; $i <= $totalRows; $i++) {
                if ($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue() != "") {
                    $agent = Agent::where('matricule', $spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue())->get(['id']);
                    if(isset($agent[0]->id)) {
                        Enfant::firstOrCreate([
                            'agent_id' => $agent[0]->id,
                            'prenom' => $spreadsheet->getSheetByName($sheetName)->getCell('B' . $i)->getValue(),
                            'date_naiss' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($spreadsheet->getSheetByName($sheetName)->getCell('C' . $i)->getValue())->format('Y-m-d'),
                            'lieu_naiss' => $spreadsheet->getSheetByName($sheetName)->getCell('D' . $i)->getValue(),
                            'ref_acte_naiss' => $spreadsheet->getSheetByName($sheetName)->getCell('E' . $i)->getValue(),
                            'sexe' => $spreadsheet->getSheetByName($sheetName)->getCell('F' . $i)->getValue()
                        ]);
                    }
                }
            }
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            return 'Error';
        }
    }

    private function Experiences($spreadsheet, $sheetName ,$totalRows){
        try {
            DB::beginTransaction();
            for ($i = 2; $i <= $totalRows; $i++) {
                if ($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue() != "") {
                    $agent = Agent::where('matricule', $spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue())->get(['id']);
                    if(isset($agent[0]->id)) {
                        Experience::firstOrCreate([
                            'agent_id' => $agent[0]->id,
                            'organisation' => $spreadsheet->getSheetByName($sheetName)->getCell('B' . $i)->getValue(),
                            'date_debut' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($spreadsheet->getSheetByName($sheetName)->getCell('C' . $i)->getValue())->format('Y-m-d'),
                            'date_fin' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($spreadsheet->getSheetByName($sheetName)->getCell('D' . $i)->getValue())->format('Y-m-d'),
                            'fonction' => $spreadsheet->getSheetByName($sheetName)->getCell('E' . $i)->getValue(),
                            'tache' => $spreadsheet->getSheetByName($sheetName)->getCell('F' . $i)->getValue(),
                            'observation' => $spreadsheet->getSheetByName($sheetName)->getCell('G' . $i)->getValue()
                        ]);
                    }
                }
            }
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            return 'Error';
        }
    }

    private function Notations($spreadsheet, $sheetName ,$totalRows){
        try {
            DB::beginTransaction();
            for ($i = 2; $i <= $totalRows; $i++) {
                if ($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue() != "") {
                    $agent = Agent::where('matricule', $spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue())->get(['id']);
                    if(isset($agent[0]->id)) {
                        Notation::firstOrCreate([
                            'agent_id' => $agent[0]->id,
                            'date_debut' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($spreadsheet->getSheetByName($sheetName)->getCell('B' . $i)->getValue())->format('Y-m-d'),
                            'date_fin' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($spreadsheet->getSheetByName($sheetName)->getCell('C' . $i)->getValue())->format('Y-m-d'),
                            'note' => $spreadsheet->getSheetByName($sheetName)->getCell('D' . $i)->getValue(),
                            'responsable' => $spreadsheet->getSheetByName($sheetName)->getCell('E' . $i)->getValue(),
                            'observation' => $spreadsheet->getSheetByName($sheetName)->getCell('F' . $i)->getValue()
                        ]);
                    }
                }
            }
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            return 'Error';
        }
    }

    private function Retraites($spreadsheet, $sheetName ,$totalRows){
        try {
            DB::beginTransaction();
            for ($i = 2; $i <= $totalRows; $i++) {
                if ($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue() != "") {
                    $agent = Agent::where('matricule', $spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue())->get(['id']);
                    if(isset($agent[0]->id)) {
                        Retraite::firstOrCreate([
                            'agent_id' => $agent[0]->id,
                            'date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($spreadsheet->getSheetByName($sheetName)->getCell('B' . $i)->getValue())->format('Y-m-d'),
                            'ref_decision' => $spreadsheet->getSheetByName($sheetName)->getCell('C' . $i)->getValue(),
                            'date_decision' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($spreadsheet->getSheetByName($sheetName)->getCell('D' . $i)->getValue())->format('Y-m-d'),
                            'lieu' => $spreadsheet->getSheetByName($sheetName)->getCell('E' . $i)->getValue(),
                            'contact' => $spreadsheet->getSheetByName($sheetName)->getCell('F' . $i)->getValue(),
                            'observation' => $spreadsheet->getSheetByName($sheetName)->getCell('G' . $i)->getValue()
                        ]);
                    }
                }
            }
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            return 'Error';
        }
    }

    private function Diplomes($spreadsheet, $sheetName ,$totalRows){
        try {
            DB::beginTransaction();
            for ($i = 2; $i <= $totalRows; $i++) {
                if ($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue() != "") {
                    Diplome::firstOrCreate([
                        'id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue()),
                        'name' => $spreadsheet->getSheetByName($sheetName)->getCell('B' . $i)->getValue()
                    ]);
                }
            }
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            return 'Error';
        }
    }

    private function EcoleFormations($spreadsheet, $sheetName ,$totalRows){
        try {
            DB::beginTransaction();
            for ($i = 2; $i <= $totalRows; $i++) {
                if ($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue() != "") {
                    EcoleFormation::firstOrCreate([
                        'id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue()),
                        'name' => $spreadsheet->getSheetByName($sheetName)->getCell('B' . $i)->getValue()
                    ]);
                }
            }
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            return 'Error';
        }
    }

    private function EquivalenceDiplomes($spreadsheet, $sheetName ,$totalRows){
        try {
            DB::beginTransaction();
            for ($i = 2; $i <= $totalRows; $i++) {
                if ($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue() != "") {
                    EquivalenceDiplome::firstOrCreate([
                        'id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue()),
                        'name' => $spreadsheet->getSheetByName($sheetName)->getCell('B' . $i)->getValue()
                    ]);
                }
            }
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            return 'Error';
        }
    }

    private function NiveauEtudes($spreadsheet, $sheetName ,$totalRows){
        try {
            DB::beginTransaction();
            for ($i = 2; $i <= $totalRows; $i++) {
                if ($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue() != "") {
                    NiveauEtude::firstOrCreate([
                        'id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue()),
                        'name' => $spreadsheet->getSheetByName($sheetName)->getCell('B' . $i)->getValue()
                    ]);
                }
            }
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            return 'Error';
        }
    }

    private function Formations($spreadsheet, $sheetName ,$totalRows){
        try {
            DB::beginTransaction();
            for ($i = 2; $i <= $totalRows; $i++) {
                if ($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue() != "") {
                    $agent = Agent::where('matricule', $spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue())->get(['id']);
                    if(isset($agent[0]->id)) {
                        Formation::firstOrCreate([
                            'agent_id' => $agent[0]->id,
                            'date_debut' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($spreadsheet->getSheetByName($sheetName)->getCell('F' . $i)->getValue())->format('Y-m-d'),
                            'date_fin' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($spreadsheet->getSheetByName($sheetName)->getCell('G' . $i)->getValue())->format('Y-m-d'),
                            'ecole_formation_id' => $spreadsheet->getSheetByName($sheetName)->getCell('B' . $i)->getValue(),
                            'diplome_id' => $spreadsheet->getSheetByName($sheetName)->getCell('C' . $i)->getValue(),
                            'niveau_etude_id' => $spreadsheet->getSheetByName($sheetName)->getCell('D' . $i)->getValue(),
                            'equivalence_diplome_id' => $spreadsheet->getSheetByName($sheetName)->getCell('E' . $i)->getValue(),
                        ]);
                    }
                }
            }
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            return 'Error';
        }
    }

    private function Maladies($spreadsheet, $sheetName ,$totalRows){
        try {
            DB::beginTransaction();
            for ($i = 2; $i <= $totalRows; $i++) {
                if ($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue() != "") {
                    Maladie::firstOrCreate([
                        'id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue()),
                        'name' => $spreadsheet->getSheetByName($sheetName)->getCell('B' . $i)->getValue()
                    ]);
                }
            }
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            return 'Error';
        }
    }

    private function AgentsMaladies($spreadsheet, $sheetName ,$totalRows){
        try {
            DB::beginTransaction();
            for ($i = 2; $i <= $totalRows; $i++) {
                if ($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue() != "") {
                    $agent = Agent::where('matricule', $spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue())->get(['id']);
                    if(isset($agent[0])) {
                        $agent[0]->maladies()->attach($spreadsheet->getSheetByName($sheetName)->getCell('B' . $i)->getValue(), [
                            'observation' => $spreadsheet->getSheetByName($sheetName)->getCell('C' . $i)->getValue(),
                            'date_observation' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($spreadsheet->getSheetByName($sheetName)->getCell('D' . $i)->getValue())->format('Y-m-d')
                        ]);
                    }
                }
            }
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            return 'Error';
        }
    }

    private function Matrimoniales($spreadsheet, $sheetName ,$totalRows){
        try {
            DB::beginTransaction();
            for ($i = 2; $i <= $totalRows; $i++) {
                if ($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue() != "") {
                    Matrimoniale::firstOrCreate([
                        'id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue()),
                        'name' => $spreadsheet->getSheetByName($sheetName)->getCell('B' . $i)->getValue()
                    ]);
                }
            }
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            return 'Error';
        }
    }

    private function AgentsMatrimoniales($spreadsheet, $sheetName ,$totalRows){
        try {
            DB::beginTransaction();
            for ($i = 2; $i <= $totalRows; $i++) {
                if ($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue() != "") {
                    $agent = Agent::where('matricule', $spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue())->get(['id']);
                    if(isset($agent[0])) {
                        $agent[0]->matrimoniales()->attach($spreadsheet->getSheetByName($sheetName)->getCell('B' . $i)->getValue(), [
                            'date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($spreadsheet->getSheetByName($sheetName)->getCell('C' . $i)->getValue())->format('Y-m-d')
                        ]);
                    }
                }
            }
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            return 'Error';
        }
    }

    private function PositionAdministratives($spreadsheet, $sheetName ,$totalRows){
        try {
            DB::beginTransaction();
            for ($i = 2; $i <= $totalRows; $i++) {
                if ($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue() != "") {
                    Position::firstOrCreate([
                        'id' => trim($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue()),
                        'name' => $spreadsheet->getSheetByName($sheetName)->getCell('B' . $i)->getValue()
                    ]);
                }
            }
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            return 'Error';
        }
    }

    private function AgentsPositions($spreadsheet, $sheetName ,$totalRows){
        try {
            DB::beginTransaction();
            for ($i = 2; $i <= $totalRows; $i++) {
                if ($spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue() != "") {
                    $agent = Agent::where('matricule', $spreadsheet->getSheetByName($sheetName)->getCell('A' . $i)->getValue())->get(['id']);
                    if(isset($agent[0])) {
                        $agent[0]->positions()->attach($spreadsheet->getSheetByName($sheetName)->getCell('B' . $i)->getValue(), [
                            'ref_decision' => $spreadsheet->getSheetByName($sheetName)->getCell('D' . $i)->getValue(),
                            'date_decision' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($spreadsheet->getSheetByName($sheetName)->getCell('E' . $i)->getValue())->format('Y-m-d'),
                            'date_effet' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($spreadsheet->getSheetByName($sheetName)->getCell('C' . $i)->getValue())->format('Y-m-d'),
                            'date_fin' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($spreadsheet->getSheetByName($sheetName)->getCell('F' . $i)->getValue())->format('Y-m-d'),
                            'observation' => $spreadsheet->getSheetByName($sheetName)->getCell('G' . $i)->getValue(),
                        ]);
                    }
                }
            }
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();
            return 'Error';
        }
    }
}
