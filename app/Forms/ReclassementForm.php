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
                'label' => 'Agent',
                'rules' => 'required|integer',
                'class' => Titulaire::class,
                'query_builder' => function (Titulaire $titulaire) {
                    return $titulaire->pluck('matricule', 'id');
                }
            ])
            ->add('category_id', 'entity', [
                'label' => 'Catégorie',
                'rules' => 'required|integer',
                'class' => Category::class,
                'query_builder' => function (Category $category) {
                    return $category->pluck('name', 'id');
                }
            ])
            ->add('classe_id', 'entity', [
                'label' => 'Classe',
                'rules' => 'required|integer',
                'class' => Classe::class,
                'query_builder' => function (Classe $classe) {
                    return $classe->pluck('name', 'id');
                }
            ])
            ->add('echelon_id', 'entity', [
                'label' => 'Echelon',
                'rules' => 'required|integer',
                'class' => Echelon::class,
                'query_builder' => function (Echelon $echelon) {
                    return $echelon->pluck('name', 'id');
                },
                'empty_value' => 'Séléctionner'
            ])
            ->add('ref_reclassement', 'text', [
                'rules' => 'required'
            ])
            ->add('date_reclassement', 'text', [
                'rules' => 'required|date'
            ])
            ->add('indice_id', 'text', [
                'attr' => ['hidden' => true, 'id' => 'indice_id']
            ]);
    }
}
