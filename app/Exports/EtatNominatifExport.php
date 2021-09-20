<?php

namespace App\Exports;

use App\Models\Agent;
use App\Models\Avancement;
use App\Models\Auxiliaire;
use App\Models\Category;
use App\Models\Classe;
use App\Models\Indice;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EtatNominatifExport implements FromCollection, WithHeadings, WithMapping
{
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
            'Cate_1',
            'Classe_1',
            'Indice_1',
            'Date_Av_Jour',
            'Date_Av_Mois',
            'Cate_2',
            'Classe_2',
            'Indice_2',
            'Salbase',
            'Position'
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
        if(count($agent->grades) > 1)
        {
            $position = $agent->positions->last()->name;
            $categorie1 = $agent->grades[0]->category->name;
            $categorie2 = $agent->grades->last()->category->name;
            $classe1 = $agent->grades[0]->classe->name;
            $classe2 = $agent->grades->last()->classe->name;
            $indice1 = $agent->grades[0]->indice->name;
            $indice2 = $agent->grades->last()->indice->name;
            $dated = explode('-', $agent->grades->last()->date_decision_avancement); // ['foo', 'bar', 'foobar']
            $jour_av = $dated[2];
            $mois_av = $dated[1];
            //$annee_av = $dated[0];
            $salbase = $agent->grades->last()->indice->salary;
            $agents = [
                $agent->id,
                $agent->matricule,
                $agent->nom,
                $agent->prenom,
                $categorie1,
                $classe1,
                $indice1,
                $jour_av,
                $mois_av,
                $categorie2,
                $classe2,
                $indice2,
                $salbase,
                $position
    
            ];
        } else {
            if($agent->grades[0]->indice)
            {
                $salbase = $agent->grades[0]->indice->salary;
                $classe1 = $agent->grades[0]->classe->name;
                $classe2 = $agent->grades->last()->classe->name;
                $indice1 = $agent->grades[0]->indice->name;
                $indice2 = $agent->grades->last()->indice->name;
                $categorie1 = $agent->grades[0]->category->name;
                $categorie2 = $agent->grades->last()->category->name;
                $jour_av = 0;
                $mois_av = 0;
                $position = $agent->positions->last()->name;
            } else{
                $categorie1 = '';
                $categorie2 = '';
                $classe1 = '';
                $classe2 = '';
                $indice1 = '';
                $indice2 = '';
                $salbase = 0;
            }
            $position = $agent->positions->last()->name;
            $jour_av = 0;
            $mois_av = 0;
            $agents = [
                $agent->id,
                $agent->matricule,
                $agent->nom,
                $agent->prenom,
                $categorie1,
                $classe1,
                $indice1,
                $jour_av,
                $mois_av,
                $categorie2,
                $classe2,
                $indice2,
                $salbase,
                $position
    
            ];
        }
        return $agents;
        
    }

    /**
     * @return Collection
     */
    public function collection()
    {
        $agents = Agent::with(['positions','grades' => function($query) {
            return $query->with('category', 'categoryAuxiliaire','category', 'classe', 'indice');
        }])->has('grades')->get();
        //$avancement = Avancement::with('agent', 'category', 'classe', 'echelon')->get();
        //dd($agents);
        return $agents;
    }
}