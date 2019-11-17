<?php
namespace App\Exports;


use App\Models\Agent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ParMatrimonialeExport implements FromCollection, WithHeadings, WithMapping {
    use Exportable;

    private $matrimoniale_id;

    public function __construct($matrimoniale_id)
    {
        $this->matrimoniale_id = $matrimoniale_id;
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
            "Situation matrimoniale"
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
            $agent->matrimoniales->last()->name,

        ];
    }

    /**
     * @return Collection
     */
    public function collection()
    {
        if($this->matrimoniale_id) {
            $agents = Agent::whereHas('matrimoniales', function (Builder $query) {
                $query->where('agent_matrimoniale.matrimoniale_id', '=', $this->matrimoniale_id);
            })->with('matrimoniales')->get();

            $agents = $agents->filter(function($agent){
                return $agent->matrimoniales->last()->id == $this->matrimoniale_id;
            });
        }else {
            $agents = Agent::has('matrimoniales')->with('matrimoniales');
            $agents = $agents->get();

        }
        return $agents;

    }
}