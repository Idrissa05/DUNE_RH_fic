<?php

namespace App\Exports;

use App\Models\Agent;
use Maatwebsite\Excel\Concerns\FromCollection;

class EtatNominatifExport implements FromCollection
{
    /**
    * 
    */
    public function collection()
    {
        return Agent::select('matricule', 'nom', 'prenom')->get();
    }
}