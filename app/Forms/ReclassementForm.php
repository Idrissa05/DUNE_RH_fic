<?php

namespace App\Forms;

use App\Models\Agent;
use App\Models\Cadre;
use App\Models\Category;
use App\Models\Classe;
use App\Models\Corp;
use App\Models\Echelon;
use App\Models\Fonction;
use App\Models\Titulaire;
use Kris\LaravelFormBuilder\Form;

class ReclassementForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('agent_id', 'entity', [
                'label' => 'Matricule Agent',
                //'rules' => 'required|integer',
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
            ->add('cadre_id','entity', [
                'class' => Cadre::class,
                'label' => 'Cadre *', 'rules' => 'required',
                'query_builder' => function (Cadre $cadre) {
                    return $cadre->orderBy('name', 'asc')->pluck('name','id');
                },
                'empty_value' => 'Sélectionner'
            ])
            ->add('corp_id','entity', [
                'class' => Corp::class,
                'label' => 'Corps *', 'rules' => 'required',
                'query_builder' => function (Corp $corp) {
                    return $corp->orderBy('name', 'asc')->pluck('name','id');
                },
                'empty_value' => 'Sélectionner'
            ])
            ->add('fonction_id','entity', [
                'class' => Fonction::class, 'rules' => 'required',
                'label' => 'Fonction *',
                'query_builder' => function (Fonction $fonction) {
                    return $fonction->orderBy('name', 'asc')->pluck('name','id');
                },
                'empty_value' => 'Sélectionner'
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
