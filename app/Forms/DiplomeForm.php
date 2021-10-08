<?php

namespace App\Forms;

use App\Models\EquivalenceDiplome;
use App\Models\NiveauEtude;
use Kris\LaravelFormBuilder\Form;

class DiplomeForm extends Form
{
    public function buildForm()
    {
        $this->add('name', 'text', [
            'label' => 'Libellé',
            'rules' => 'required|string'
        ])
        ->add('equivalence_diplome_id', 'entity', [
            'label' => 'Equivalence',
            'rules' => 'required|integer',
            'class' => EquivalenceDiplome::class,
            'empty_value' => 'Sélectionner',
            'query_builder' => function (EquivalenceDiplome $category) {
                return $category->orderBy('name', 'asc')->pluck('name', 'id');
            }
        ])
        ->add('niveau_etude_id', 'entity', [
            'label' => 'Niveau d etude',
            'rules' => 'required|integer',
            'class' => NiveauEtude::class,
            'empty_value' => 'Sélectionner',
            'query_builder' => function (NiveauEtude $category) {
                return $category->orderBy('name', 'asc')->pluck('name', 'id');
            }
        ]);
    }
}
