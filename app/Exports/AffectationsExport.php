<?php
namespace App\Exports;


use App\Models\Affectation;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AffectationsExport implements FromQuery, WithHeadings, WithMapping {
    use Exportable;

    /**
     * @var Request
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function headings(): array {
        return [
            'No',
            'Matricule',
            'Nom',
            'Prénom',
            'sexe',
            'Fonction',
            "Région",
            "Département",
            "Commune",
            "Inspection",
            "Secteur pédagogique",
            "Etablissement",
        ];
    }

    /**
     * @param mixed $agent
     *
     * @return array
     */
    public function map($agent): array
    {
        return [
            $agent->id,
            $agent->matricule,
            $agent->nom,
            $agent->prenom,
            $agent->sexe,
            $agent->fonction,
            $agent->region,
            $agent->departement,
            $agent->commune,
            $agent->inspection,
            $agent->secteur,
            $agent->etablissement,

        ];
    }

    /**
     * @return Builder
     */
    public function query()
    {
        $query = Affectation::query()
            ->join('agents', 'agents.id', '=', 'affectations.agent_id')
            ->join('grades', 'grades.agent_id', '=', 'agents.id')
            ->join('fonctions', 'fonctions.id', '=', 'grades.fonction_id')
            ->join('etablissements', 'etablissements.id', '=', 'affectations.etablissement_id')
            ->join('secteur_pedagogiques', 'secteur_pedagogiques.id', 'etablissements.secteur_pedagogique_id')
            ->join('inspections', 'inspections.id', '=', 'secteur_pedagogiques.inspection_id')
            ->join('communes', 'communes.id', '=', 'inspections.commune_id')
            ->join('departements', 'departements.id', 'communes.departement_id')
            ->join('regions', 'regions.id', 'departements.region_id')
            ->orderByDesc('affectations.created_at')
            ->whereRaw('affectations.created_at = (SELECT max(affectations.created_at) from affectations where affectations.agent_id=agents.id)')
            ->selectRaw('agents.id ,affectations.created_at, agents.matricule, agents.nom, agents.prenom,agents.sexe, regions.name as region, departements.name as departement, inspections.name as inspection, secteur_pedagogiques.name secteur, fonctions.name as fonction, etablissements.name as etablissement, communes.name as commune');
        if(auth()->user()->role != 'Administrateur') {
            $query->whereRaw('agents.created_by_ministere_id = :ministere', ['ministere' => auth()->user()->ministere_id]);
        }
        if($this->request->region) {
            $query->where('regions.id', '=', $this->request->region);
        }
        if($this->request->departement) {
            $query->where('departements.id', '=', $this->request->departement);
        }
        if($this->request->commune) {
            $query->where('communes.id', '=', $this->request->commune);
        }
        if($this->request->inspection) {
            $query->where('inspections.id', '=', $this->request->inspection);
        }
        if($this->request->secteur) {
            $query->where('secteur_pedagogiques.id', '=', $this->request->secteur);
        }
        if($this->request->sexe) {
            $query->where('agents.sexe', '=', $this->request->sexe);
        }
        if($this->request->fonction) {
            $query->where('fonctions.id', '=', $this->request->fonction);
        }
        if($this->request->etablissement) {
            $query->where('etablissements.id', '=', $this->request->etablissement);
        }
        return $query;
    }
}