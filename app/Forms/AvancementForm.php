<?php

namespace App\Forms;

use App\Models\Cadre;
use App\Models\Category;
use App\Models\Classe;
use App\Models\Corp;
use App\Models\Echelon;
use App\Models\Fonction;
use App\Models\Titulaire;
use Kris\LaravelFormBuilder\Form;

class AvancementForm extends Form
{
    public function buildForm()
    {
            $this->add('agent_id','select', [
                    //'class' => Titulaire::class,
                    'label' => 'Matricule Agent *', 'attr' => ['class'=>'form-control agent'],
                    /*'query_builder' => function (Titulaire $titulaire) {
                        return $titulaire->orderBy('matricule', 'asc')->pluck('matricule','id');
                    },*/
                    'empty_value' => 'Sélectionner'
                ])
                ->add('category_id','entity', [
                    'class' => Category::class,
                    'label' => 'Catégorie *', 'rules' => 'required',
                    'query_builder' => function (Category $category) {
                        return $category->orderBy('name', 'asc')->pluck('name','id');
                    },
                    'empty_value' => 'Sélectionner'
                ])
                ->add('classe_id','entity', [
                    'class' => Classe::class,
                    'label' => 'Classe *', 'rules' => 'required',
                    'query_builder' => function (Classe $classe) {
                        return $classe->orderBy('name', 'asc')->pluck('name','id');
                    },
                    'empty_value' => 'Sélectionner'
                ])
                ->add('echelon_id','entity', [
                    'class' => Echelon::class,
                    'label' => 'Echelon *', 'rules' => 'required',
                    'query_builder' => function (Echelon $echelon) {
                        return $echelon->orderBy('name', 'asc')->pluck('name','id');
                    },
                    'empty_value' => 'Sélectionner'
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
                ->add('ref_avancement', 'text', [
                    'label' => 'Ref Avancemenet *',
                    'rules' => 'required'
                ])
                ->add('date_decision_avancement', 'date', [
                    'label' => 'Date Effet Avancement *',
                    'rules' => 'required|date', 'attr' => ['max' => null, 'min' => null]
                ])
                ->add('observation_avancement','textarea', [
                    'label'=>'Observation', 'rules' => 'max:190', 'attr' => ['rows' => 3, 'placeholder' => 'Limité à 190 caractères !']
                ])
                ->add('indice_id','text', ['attr' => ['hidden' => true, 'id' => 'indice_id']])
                ->add('agent','text', ['rules' => 'required','attr' => ['hidden' => true, 'id' => 'agent']])
                ->add('indice','text', [
                    'label'=>'Indice', 'attr' => ['disabled' => 'disabled']
                ])
                ->add('salary','text', [
                    'label'=>'Salaire', 'attr' => ['disabled' => 'disabled']
                ])
            ;
    }
}
