<?php
namespace App\Exports;


use App\Models\Agent;
use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AgentsExport implements FromQuery, WithHeadings, WithMapping {
    use Exportable;

    public function headings(): array {
        return [
            'No',
            'Matricule',
            'Nom',
            'Prénom',
            'Date de naissace',
            'Lieu de naissance',
            'sexe',
            'Nationalité',
            "Type d'agent"
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
            $agent->date_naiss,
            $agent->lieu_naiss,
            $agent->sexe,
            $agent->nationalite,
            $agent->type,

        ];
    }

    /**
     * @return Builder
     */
    public function query()
    {
        return Agent::query();
    }
}