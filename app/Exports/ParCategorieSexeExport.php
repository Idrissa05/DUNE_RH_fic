<?php
namespace App\Exports;


use App\Models\Agent;
use App\Models\Auxiliaire;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ParCategorieSexeExport implements FromCollection, WithHeadings, WithMapping {
    use Exportable;

    private $sexe;
    private $categorie;

    /**
     * ParCategorieSexeExport constructor.
     * @param null $sexe
     * @param null $categorie
     */
    public function __construct($sexe = null, $categorie = null)
    {
        $this->sexe = $sexe;
        $this->categorie = $categorie;
    }

    public function headings(): array {
        return [
            'No',
            'Matricule',
            'Nom',
            'Prénom',
            'Date de naissace',
            'Lieu de naissance',
            'sexe',
            'Catégorie'
        ];
    }

    /**
     * @param mixed $agent
     *
     * @return array
     */
    public function map($agent): array
    {
        $categorie = $agent instanceof Auxiliaire ?
            $agent->grades->last()->categoryAuxiliaire->name :
            $agent->grades->last()->category->name;
        return [
            $agent->id,
            $agent->matricule,
            $agent->nom,
            $agent->prenom,
            $agent->date_naiss,
            $agent->lieu_naiss,
            $agent->sexe,
            $categorie

        ];
    }

    /**
     * @return Collection
     */
    public function collection()
    {
        $agents = Agent::with(['grades' => function($query) {
            return $query->with('category', 'categoryAuxiliaire');
        }])->has('grades');
        if($this->sexe) {
            $agents->where('sexe', '=', $this->sexe);
        }
        $agents = $agents->get();

        if($this->categorie) {
            $agents = $agents->filter(function ($agent){
                return $agent->grades->last()->category ?
                    $agent->grades->last()->category->name == $this->categorie :
                    $agent->grades->last()->categoryAuxiliaire->name == $this->categorie;
            });
        }
        return $agents;
    }
}