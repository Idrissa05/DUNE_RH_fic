<?php
namespace App\Exports;


use App\Models\Agent;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ParPositionExport implements FromCollection, WithHeadings, WithMapping {
    use Exportable;

    private $position_id;

    public function __construct($position_id)
    {
        $this->position_id = $position_id;
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
            "Position"
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
            $agent->positions->last()->name,

        ];
    }

    /**
     * @return Collection
     */
    public function collection()
    {
        if($this->position_id) {
            $agents = Agent::whereHas('positions', function ($query) {
                $query->where('agent_position.position_id', '=', $this->position_id);
            })->with('positions')->get();

            $agents = $agents->filter(function($agent){
                return $agent->positions->last()->id == $this->position_id;
            });
        }else {
            $agents = Agent::has('positions')->with('positions');
            $agents = $agents->get();
        }
        return $agents;

    }
}