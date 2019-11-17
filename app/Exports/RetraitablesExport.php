<?php
namespace App\Exports;


use App\Models\Agent;
use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RetraitablesExport implements FromQuery, WithHeadings, WithMapping {
    use Exportable;

    public function headings(): array {
        return [
            'No',
            'Matricule',
            'Nom',
            'Prénom',
            'sexe',
            'Date de naissace',
            'Lieu de naissance',
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
            $agent->lieu_naiss

        ];
    }

    /**
     * @return Builder
     */
    public function query()
    {
        return Agent::retraitable();
    }
}