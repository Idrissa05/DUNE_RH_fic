<?php

namespace App\Forms;

use App\Models\Agent;
use App\Models\Category;
use App\Models\Classe;
use App\Models\Echelon;
use App\Models\Titulaire;
use Kris\LaravelFormBuilder\Form;

class ReclassementForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('agent_id', 'entity', [
                'label' => 'Matricule Agent',
                'rules' => 'required|integer',
                'class' => Titulaire::class,
                'empty_value' => 'Sélectionner',
                'query_builder' => function (Titulaire $titulaire) {
                    return $titulaire->orderBy('matricule', 'asc')->pluck('matricule', 'id');
                }
            ])
            ->add('category_id', 'entity', [
                'label' => 'Catégorie',
                'rules' => 'required|integer',
                'class' => Category::class,
                'empty_value' => 'Sélectionner',
                'query_builder' => function (Category $category) {
                    return $category->orderBy('name', 'asc')->pluck('name', 'id');
                }
            ])
            ->add('classe_id', 'entity', [
                'label' => 'Classe',
                'rules' => 'required|integer',
                'class' => Classe::class,
                'empty_value' => 'Sélectionner',
                'query_builder' => function (Classe $classe) {
                    return $classe->orderBy('name', 'asc')->pluck('name', 'id');
                }
            ])
            ->add('echelon_id', 'entity', [
                'label' => 'Echelon',
                'rules' => 'required|integer',
                'class' => Echelon::class,
                'empty_value' => 'Sélectionner',
                'query_builder' => function (Echelon $echelon) {
                    return $echelon->orderBy('name', 'asc')->pluck('name', 'id');
                },
            ])
            ->add('ref_reclassement', 'text', [
                'rules' => 'required'
            ])
            ->add('date_reclassement', 'date', [
                'rules' => 'required|date'
            ])
            ->add('indice_id', 'text', [
                'attr' => ['hidden' => true, 'id' => 'indice_id']
            ])
            ->add('indice','text', [
                'label'=>'Indice', 'attr' => ['disabled' => 'disabled']
            ])
            ->add('salary','text', [
                'label'=>'Salaire', 'attr' => ['disabled' => 'disabled']
            ]);
    }
}
