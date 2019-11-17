<?php
namespace App\Exports;


use App\Models\Agent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ParCorpExport implements FromCollection, WithHeadings, WithMapping {
    use Exportable;

    private $corp_id;

    public function __construct($corp_id)
    {
        $this->corp_id = $corp_id;
    }

    public function headings(): array {
        return [
            'No',
            'Matricule',
            'Nom',
            'Prénom',
            'sexe',
            'Date de naissace',
            'Lieu de naissance',
            "Corps"
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
            $agent->date_naiss,
            $agent->lieu_naiss,
            $agent->grades->last()->corp->name,

        ];
    }

    /**
     * @return Collection
     */
    public function collection()
    {
        if($this->corp_id) {
            $agents = Agent::whereHas('grades.corp', function($query){
                $query->where('corps.id', '=', $this->corp_id);
            })->with('grades.corp')->get();
            $agents = $agents->filter(function ($agent){
                return $agent->grades->last()->corp_id == $this->corp_id;
            });
        }else {
            $agents = Agent::has('grades.corp')->with('grades.corp')->get();
        }
        return $agents;

    }
}